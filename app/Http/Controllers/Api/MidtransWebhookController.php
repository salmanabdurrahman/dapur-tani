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
        Config::$isProduction = false;

        try {
            $notification = new Notification();

            $orderId = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;

            $order = Order::where('order_number', $orderId)->first();

            if (!$order) {
                Log::warning("Webhook Ignored: Order not found for order_id {$orderId}");
                return response()->json([
                    'message' => 'Order not found'
                ], 404);
            }

            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $order->update(['status' => 'processing']);
                }
            } else if ($transactionStatus == 'settlement') {
                $order->update(['status' => 'processing']);
            } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
                $order->update(['status' => 'cancelled']);
            }

            Log::info("Webhook Success: Order {$orderId} status updated to {$order->status->value}");

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
}
