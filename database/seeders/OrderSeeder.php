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

        // Create 100 random orders
        for ($i = 0; $i < 100; $i++) {
            $buyer = $buyers->random();
            $product = $products->random();
            $quantity = rand(1, 5);
            $totalAmount = $product->price * $quantity;
            $status = $this->randomStatus();

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

            if ($status === OrderStatus::COMPLETED->value && rand(1, 10) <= 9) {
                Review::create([
                    'user_id' => $buyer->id,
                    'product_id' => $product->id,
                    'order_id' => $order->id,
                    'rating' => rand(4, 5),
                    'comment' => $this->randomComment(),
                    'created_at' => now()->subDays(rand(1, 180)),
                ]);
            }
        }

        // Create random promotions for products
        $promoProducts = Product::inRandomOrder()->limit(10)->get();
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
        $subProducts = Product::inRandomOrder()->limit(12)->get();
        $subBuyers = $buyers->random(min(2, $buyers->count()));
        $subBuyers = $subBuyers instanceof \Illuminate\Support\Collection ? $subBuyers->values() : collect([$subBuyers]);
        foreach ($subProducts as $index => $subProduct) {
            $buyerIndex = $index % $subBuyers->count();
            RecurringOrder::create([
                'user_id' => $subBuyers[$buyerIndex]->id,
                'product_id' => $subProduct->id,
                'quantity' => rand(2, 5),
                'frequency' => 'weekly',
                'day_of_week' => ['monday', 'wednesday', 'friday'][array_rand(['monday', 'wednesday', 'friday'])],
                'is_active' => true,
            ]);
        }
    }

    private function randomComment(): string
    {
        $templates = [
            'Produk ini sangat segar dan berkualitas!',
            'Pengiriman cepat dan produk sesuai deskripsi.',
            'Sangat puas dengan pelayanan dan kualitas produk.',
            'Harga terjangkau untuk produk sebaik ini.',
            'Akan membeli lagi di masa depan.',
            'Pelayanan penjual sangat ramah dan responsif.',
            'Packing rapi, produk sampai dengan aman.',
            'Rekomendasi untuk yang mencari produk segar.',
            'Kualitas produk melebihi ekspektasi saya.',
            'Transaksi mudah dan proses cepat.',
            'Produk dikirim sesuai pesanan, tidak ada yang kurang.',
            'Sangat membantu kebutuhan dapur saya.',
            'Produk organik dan sehat, cocok untuk keluarga.',
            'Terima kasih, pesanan saya diterima dengan baik.',
            'Suka sekali dengan rasa dan kesegaran produknya.',
            'Penjual memberikan informasi yang jelas.',
            'Pengiriman tepat waktu, sangat memuaskan.',
            'Produk selalu fresh setiap kali order.',
            'Harga bersaing dan kualitas tetap terjaga.',
            'Sudah beberapa kali order, selalu puas.',
            'Produk sesuai foto dan deskripsi di toko.',
            'Sangat direkomendasikan untuk belanja kebutuhan harian.',
            'Respon penjual sangat cepat dan membantu.',
            'Produk sampai dalam kondisi baik dan segar.',
            'Belanja di sini selalu menyenangkan.',
        ];

        return $templates[array_rand($templates)];
    }

    private function randomStatus(): string
    {
        $statuses = ['pending_payment', 'processing', 'shipped', 'delivered', 'completed', 'completed', 'completed'];
        return $statuses[array_rand($statuses)];
    }
}
