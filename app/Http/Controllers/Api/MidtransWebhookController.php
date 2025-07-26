<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production', false);

        try {
            $notification = new Notification();

            $orderId = $notification->order_id ?? null;
            $transactionStatus = $notification->transaction_status ?? null;
            $fraudStatus = $notification->fraud_status ?? null;

            if (!$orderId || !$transactionStatus) {
                Log::warning("Webhook Ignored: Missing order_id or transaction_status");
                return response()->json([
                    'message' => 'Invalid webhook payload'
                ], 400);
            }

            $order = Order::where('order_number', $orderId)->first();

            if (!$order) {
                Log::warning("Webhook Ignored: Order not found for order_id {$orderId}");
                return response()->json([
                    'message' => 'Order not found'
                ], 404);
            }

            $newStatus = $this->mapTransactionStatus($transactionStatus, $fraudStatus);

            if ($newStatus && $order->status !== $newStatus) {
                $order->update(['status' => $newStatus]);
                Log::info("Webhook Success: Order {$orderId} status updated to {$newStatus}");
            } else {
                Log::info("Webhook Info: Order {$orderId} status unchanged (" . (string) $order->status . ")");
            }

            return response()->json([
                'message' => 'Webhook processed successfully'
            ]);
        } catch (\Exception $e) {
            Log::error("Midtrans Webhook Error: " . $e->getMessage());
            return response()->json([
                'message' => 'Error processing webhook'
            ], 500);
        }
    }

    /**
     * Map Midtrans transaction status and fraud status to order status.
     */
    protected function mapTransactionStatus($transactionStatus, $fraudStatus)
    {
        switch ($transactionStatus) {
            case 'capture':
                return $fraudStatus === 'accept' ? 'processing' : null;
            case 'settlement':
                return 'processing';
            case 'cancel':
            case 'deny':
            case 'expire':
                return 'cancelled';
            default:
                return null;
        }
    }
}
