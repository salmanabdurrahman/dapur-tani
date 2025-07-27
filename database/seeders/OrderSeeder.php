<?php

namespace Database\Seeders;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\RecurringOrder;
use App\Models\Review;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buyers = User::where('role', 'buyer')->get();
        $products = Product::all();

        if ($products->isEmpty() || $buyers->isEmpty()) {
            return;
        }

        // Create 50 random orders
        for ($i = 0; $i < 50; $i++) {
            $buyer = $buyers->random();
            $product = $products->random();
            $quantity = rand(1, 5);
            $totalAmount = $product->price * $quantity;
            $status = OrderStatus::cases()[array_rand(OrderStatus::cases())];

            $order = Order::create([
                'buyer_id' => $buyer->id,
                'order_number' => 'INV-' . strtoupper(uniqid()),
                'total_amount' => $totalAmount,
                'status' => $status,
                'shipping_address' => $buyer->profile->address,
                'created_at' => now()->subDays(rand(1, 180)),
            ]);

            $order->items()->create([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'price_per_unit' => $product->price,
                'quantity' => $quantity,
            ]);

            $product->decrement('stock_quantity', $quantity);

            $supplier = $product->supplier;
            if ($supplier) {
                $supplier->notify(new NewOrderNotification($order));
            }

            if ($status === OrderStatus::COMPLETED && rand(1, 10) <= 7) {
                Review::create([
                    'user_id' => $buyer->id,
                    'product_id' => $product->id,
                    'order_id' => $order->id,
                    'rating' => rand(4, 5),
                    'comment' => 'Produknya sangat bagus dan segar! Pengiriman cepat.',
                ]);
            }
        }

        // Create random promotions for products
        $promoProducts = Product::inRandomOrder()->limit(3)->get();
        foreach ($promoProducts as $promoProduct) {
            Promotion::create([
                'supplier_id' => $promoProduct->supplier_id,
                'product_id' => $promoProduct->id,
                'type' => 'percentage',
                'value' => rand(10, 25),
                'is_active' => true,
            ]);
        }

        // Create random recurring orders for buyers
        $subProducts = Product::inRandomOrder()->limit(2)->get();
        $subBuyers = $buyers->random(2);
        foreach ($subProducts as $index => $subProduct) {
            RecurringOrder::create([
                'user_id' => $subBuyers[$index]->id,
                'product_id' => $subProduct->id,
                'quantity' => rand(2, 5),
                'frequency' => 'weekly',
                'day_of_week' => ['monday', 'wednesday', 'friday'][array_rand(['monday', 'wednesday', 'friday'])],
                'is_active' => true,
            ]);
        }
    }
}
