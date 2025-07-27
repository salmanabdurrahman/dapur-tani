<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\NewOrderNotification;
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

            $orderId = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;

            $order = Order::where('order_number', $orderId)->first();

            if (!$order) {
                Log::warning("Webhook Ignored: Order not found for order_id {$orderId}");

                return response()
                    ->json([
                        'message' => 'Order not found'
                    ], 404);
            }

            if ($order->status !== OrderStatus::PENDING_PAYMENT->value) {
                Log::info("Webhook Ignored: Order {$orderId} status is not pending payment.");

                return response()
                    ->json([
                        'message' => 'Order status is not pending payment'
                    ]);
            }

            if ($transactionStatus == 'settlement' || ($transactionStatus == 'capture' && $fraudStatus == 'accept')) {
                $order->update([
                    'status' => OrderStatus::PROCESSING->value
                ]);

                $this->notifySuppliers($order);

                Log::info("Webhook Success: Order {$orderId} status updated to PROCESSING.");
            } else if (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                $order->update([
                    'status' => OrderStatus::CANCELLED->value
                ]);

                Log::info("Webhook Success: Order {$orderId} status updated to CANCELLED.");
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

    protected function notifySuppliers(Order $order)
    {
        $order->load('items.product.supplier');
        $suppliers = $order->items->map(fn($item) => $item->product->supplier)->unique('id');

        foreach ($suppliers as $supplier) {
            if ($supplier) {
                $supplier->notify(new NewOrderNotification($order));
            }
        }
    }
}
