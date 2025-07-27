<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplier1 = User::where('email', 'sutrisno@gmail.com')->first();
        $supplier2 = User::where('email', 'pujiastuti@gmail.com')->first();
        $supplier3 = User::where('email', 'dono@gmail.com')->first();
        $supplier4 = User::where('email', 'karyo@gmail.com')->first();

        $sayuran = Category::where('name', 'Sayuran Segar')->first();
        $buah = Category::where('name', 'Buah-buahan')->first();
        $daging = Category::where('name', 'Daging dan Unggas')->first();

        $products = [
            // Supplier 1 (Sutrisno - Tani Makmur Sleman)
            ['name' => 'Tomat Ceri Organik', 'category_id' => $sayuran->id, 'price' => 25000, 'unit' => 'kg', 'stock' => 50, 'supplier_id' => $supplier1->id],
            ['name' => 'Selada Romain Hidroponik', 'category_id' => $sayuran->id, 'price' => 18000, 'unit' => 'ikat', 'stock' => 100, 'supplier_id' => $supplier1->id],
            ['name' => 'Timun Jepang (Kyuri)', 'category_id' => $sayuran->id, 'price' => 22000, 'unit' => 'kg', 'stock' => 70, 'supplier_id' => $supplier1->id],
            ['name' => 'Paprika Merah', 'category_id' => $sayuran->id, 'price' => 45000, 'unit' => 'kg', 'stock' => 40, 'supplier_id' => $supplier1->id],
            ['name' => 'Terong Ungu', 'category_id' => $sayuran->id, 'price' => 12000, 'unit' => 'kg', 'stock' => 80, 'supplier_id' => $supplier1->id],

            // Supplier 2 (Pujiastuti - Sayur Segar Bantul)
            ['name' => 'Cabai Rawit Merah', 'category_id' => $sayuran->id, 'price' => 60000, 'unit' => 'kg', 'stock' => 30, 'supplier_id' => $supplier2->id],
            ['name' => 'Bayam Segar Ikat', 'category_id' => $sayuran->id, 'price' => 3000, 'unit' => 'ikat', 'stock' => 200, 'supplier_id' => $supplier2->id],
            ['name' => 'Kangkung Organik', 'category_id' => $sayuran->id, 'price' => 3500, 'unit' => 'ikat', 'stock' => 150, 'supplier_id' => $supplier2->id],
            ['name' => 'Bawang Merah Lokal', 'category_id' => $sayuran->id, 'price' => 38000, 'unit' => 'kg', 'stock' => 120, 'supplier_id' => $supplier2->id],
            ['name' => 'Wortel Berastagi', 'category_id' => $sayuran->id, 'price' => 15000, 'unit' => 'kg', 'stock' => 90, 'supplier_id' => $supplier2->id],

            // Supplier 3 (Dono - Kulon Progo Fruit Farm)
            ['name' => 'Alpukat Mentega Jumbo', 'category_id' => $buah->id, 'price' => 35000, 'unit' => 'kg', 'stock' => 60, 'supplier_id' => $supplier3->id],
            ['name' => 'Pisang Ambon Super', 'category_id' => $buah->id, 'price' => 20000, 'unit' => 'sisir', 'stock' => 100, 'supplier_id' => $supplier3->id],
            ['name' => 'Mangga Harum Manis', 'category_id' => $buah->id, 'price' => 28000, 'unit' => 'kg', 'stock' => 80, 'supplier_id' => $supplier3->id],
            ['name' => 'Jambu Kristal', 'category_id' => $buah->id, 'price' => 15000, 'unit' => 'kg', 'stock' => 120, 'supplier_id' => $supplier3->id],
            ['name' => 'Salak Pondoh', 'category_id' => $buah->id, 'price' => 12000, 'unit' => 'kg', 'stock' => 200, 'supplier_id' => $supplier3->id],

            // Supplier 4 (Karyo - Sumber Daging Gunungkidul)
            ['name' => 'Daging Ayam Kampung Asli', 'category_id' => $daging->id, 'price' => 55000, 'unit' => 'ekor', 'stock' => 40, 'supplier_id' => $supplier4->id],
            ['name' => 'Daging Sapi Has Dalam (Tenderloin)', 'category_id' => $daging->id, 'price' => 150000, 'unit' => 'kg', 'stock' => 20, 'supplier_id' => $supplier4->id],
            ['name' => 'Iga Sapi (Ribs)', 'category_id' => $daging->id, 'price' => 120000, 'unit' => 'kg', 'stock' => 25, 'supplier_id' => $supplier4->id],
            ['name' => 'Telur Ayam Kampung Omega-3', 'category_id' => $daging->id, 'price' => 3000, 'unit' => 'butir', 'stock' => 500, 'supplier_id' => $supplier4->id],
            ['name' => 'Daging Kambing Muda', 'category_id' => $daging->id, 'price' => 135000, 'unit' => 'kg', 'stock' => 15, 'supplier_id' => $supplier4->id],
        ];

        foreach ($products as $productData) {
            Product::create([
                'supplier_id' => $productData['supplier_id'],
                'category_id' => $productData['category_id'],
                'name' => $productData['name'],
                'description' => 'Ini adalah deskripsi untuk ' . $productData['name'] . '. Dihasilkan dari perkebunan/peternakan terbaik di Yogyakarta.',
                'price' => $productData['price'],
                'unit' => $productData['unit'],
                'stock_quantity' => $productData['stock'],
                'main_image_path' => 'product-images/placeholder.jpg',
                'is_active' => true,
                'created_at' => now()->subDays(rand(1, 180)),
            ]);
        }
    }
}
