<?php

namespace App\Console\Commands;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\RecurringOrder;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessRecurringOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recurring-orders:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process active recurring orders and create new orders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = strtolower(Carbon::now()->format('l'));

        $subscriptionsToProcess = RecurringOrder::where('is_active', true)
            ->where('day_of_week', $today)
            ->where(function ($query) {
                $query->whereNull('last_created_at')
                    ->orWhere('last_created_at', '<=', Carbon::now()->subDays(6));
            })
            ->get();

        foreach ($subscriptionsToProcess as $sub) {
            DB::transaction(function () use ($sub) {
                $order = Order::create([
                    'buyer_id' => $sub->user_id,
                    'order_number' => 'INV-SUB-' . strtoupper(uniqid()),
                    'total_amount' => $sub->product->price * $sub->quantity,
                    'status' => OrderStatus::PROCESSING,
                    'shipping_address' => $sub->user->profile->address,
                ]);

                $order->items()->create([
                    'product_id' => $sub->product_id,
                    'product_name' => $sub->product->name,
                    'price_per_unit' => $sub->product->price,
                    'quantity' => $sub->quantity,
                ]);

                $sub->update(['last_created_at' => now()]);

                Log::info("Recurring order created: {$order->order_number}");
            });
        }

        $this->info(count($subscriptionsToProcess) . ' recurring orders processed.');
    }
}
