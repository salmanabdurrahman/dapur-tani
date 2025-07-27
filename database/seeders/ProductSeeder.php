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
        // $supplier1 = User::where('email', 'sutrisno@gmail.com')->first();
        // $supplier2 = User::where('email', 'pujiastuti@gmail.com')->first();
        // $supplier3 = User::where('email', 'dono@gmail.com')->first();
        // $supplier4 = User::where('email', 'karyo@gmail.com')->first();

        // $sayuran = Category::where('name', 'Sayuran Segar')->first();
        // $buah = Category::where('name', 'Buah-buahan')->first();
        // $daging = Category::where('name', 'Daging dan Unggas')->first();

        // $products = [
        //     // Supplier 1 (Sutrisno - Tani Makmur Sleman)
        //     ['name' => 'Tomat Ceri Organik', 'category_id' => $sayuran->id, 'price' => 25000, 'unit' => 'kg', 'stock' => 50, 'supplier_id' => $supplier1->id],
        //     ['name' => 'Selada Romain Hidroponik', 'category_id' => $sayuran->id, 'price' => 18000, 'unit' => 'ikat', 'stock' => 100, 'supplier_id' => $supplier1->id],
        //     ['name' => 'Timun Jepang (Kyuri)', 'category_id' => $sayuran->id, 'price' => 22000, 'unit' => 'kg', 'stock' => 70, 'supplier_id' => $supplier1->id],
        //     ['name' => 'Paprika Merah', 'category_id' => $sayuran->id, 'price' => 45000, 'unit' => 'kg', 'stock' => 40, 'supplier_id' => $supplier1->id],
        //     ['name' => 'Terong Ungu', 'category_id' => $sayuran->id, 'price' => 12000, 'unit' => 'kg', 'stock' => 80, 'supplier_id' => $supplier1->id],

        //     // Supplier 2 (Pujiastuti - Sayur Segar Bantul)
        //     ['name' => 'Cabai Rawit Merah', 'category_id' => $sayuran->id, 'price' => 60000, 'unit' => 'kg', 'stock' => 30, 'supplier_id' => $supplier2->id],
        //     ['name' => 'Bayam Segar Ikat', 'category_id' => $sayuran->id, 'price' => 3000, 'unit' => 'ikat', 'stock' => 200, 'supplier_id' => $supplier2->id],
        //     ['name' => 'Kangkung Organik', 'category_id' => $sayuran->id, 'price' => 3500, 'unit' => 'ikat', 'stock' => 150, 'supplier_id' => $supplier2->id],
        //     ['name' => 'Bawang Merah Lokal', 'category_id' => $sayuran->id, 'price' => 38000, 'unit' => 'kg', 'stock' => 120, 'supplier_id' => $supplier2->id],
        //     ['name' => 'Wortel Berastagi', 'category_id' => $sayuran->id, 'price' => 15000, 'unit' => 'kg', 'stock' => 90, 'supplier_id' => $supplier2->id],

        //     // Supplier 3 (Dono - Kulon Progo Fruit Farm)
        //     ['name' => 'Alpukat Mentega Jumbo', 'category_id' => $buah->id, 'price' => 35000, 'unit' => 'kg', 'stock' => 60, 'supplier_id' => $supplier3->id],
        //     ['name' => 'Pisang Ambon Super', 'category_id' => $buah->id, 'price' => 20000, 'unit' => 'sisir', 'stock' => 100, 'supplier_id' => $supplier3->id],
        //     ['name' => 'Mangga Harum Manis', 'category_id' => $buah->id, 'price' => 28000, 'unit' => 'kg', 'stock' => 80, 'supplier_id' => $supplier3->id],
        //     ['name' => 'Jambu Kristal', 'category_id' => $buah->id, 'price' => 15000, 'unit' => 'kg', 'stock' => 120, 'supplier_id' => $supplier3->id],
        //     ['name' => 'Salak Pondoh', 'category_id' => $buah->id, 'price' => 12000, 'unit' => 'kg', 'stock' => 200, 'supplier_id' => $supplier3->id],

        //     // Supplier 4 (Karyo - Sumber Daging Gunungkidul)
        //     ['name' => 'Daging Ayam Kampung Asli', 'category_id' => $daging->id, 'price' => 55000, 'unit' => 'ekor', 'stock' => 40, 'supplier_id' => $supplier4->id],
        //     ['name' => 'Daging Sapi Has Dalam (Tenderloin)', 'category_id' => $daging->id, 'price' => 150000, 'unit' => 'kg', 'stock' => 20, 'supplier_id' => $supplier4->id],
        //     ['name' => 'Iga Sapi (Ribs)', 'category_id' => $daging->id, 'price' => 120000, 'unit' => 'kg', 'stock' => 25, 'supplier_id' => $supplier4->id],
        //     ['name' => 'Telur Ayam Kampung Omega-3', 'category_id' => $daging->id, 'price' => 3000, 'unit' => 'butir', 'stock' => 500, 'supplier_id' => $supplier4->id],
        //     ['name' => 'Daging Kambing Muda', 'category_id' => $daging->id, 'price' => 135000, 'unit' => 'kg', 'stock' => 15, 'supplier_id' => $supplier4->id],
        // ];

        // foreach ($products as $productData) {
        // Product::create([
        //     'supplier_id' => $productData['supplier_id'],
        //     'category_id' => $productData['category_id'],
        //     'name' => $productData['name'],
        //     'description' => 'Ini adalah deskripsi untuk ' . $productData['name'] . '. Dihasilkan dari perkebunan/peternakan terbaik di Yogyakarta.',
        //     'price' => $productData['price'],
        //     'unit' => $productData['unit'],
        //     'stock_quantity' => $productData['stock'],
        //     'main_image_path' => 'product-images/placeholder.jpg',
        //     'is_active' => true,
        //     'created_at' => now()->subDays(rand(1, 180)),
        // ]);
        // }

        $products = [
            [
                'Tani Makmur Sleman',
                1,
                2,
                [
                    ['Bayam Segar', 'ikat', 3000],
                    ['Kangkung Air', 'ikat', 3500],
                    ['Wortel Organik', 'kg', 15000],
                    ['Brokoli Hijau', 'kg', 25000],
                    ['Daun Seledri', 'ikat', 4000],
                    ['Buncis Hijau', 'kg', 18000]
                ]
            ],
            [
                'Sayur Segar Bantul',
                1,
                3,
                [
                    ['Kol Ungu', 'kg', 12000],
                    ['Sawi Putih', 'kg', 9000],
                    ['Labu Siam', 'buah', 4000],
                    ['Daun Singkong', 'ikat', 2500],
                    ['Terong Hijau', 'kg', 10000],
                    ['Kacang Panjang', 'ikat', 3500]
                ]
            ],
            [
                'Wati Fresh Sayur',
                1,
                6,
                [
                    ['Tomat Merah', 'kg', 12000],
                    ['Selada Keriting', 'ikat', 7000],
                    ['Cabe Rawit Merah', 'kg', 60000],
                    ['Timun Segar', 'kg', 8000],
                    ['Paprika Hijau', 'kg', 40000],
                    ['Jagung Manis', 'buah', 5000]
                ]
            ],

            [
                'Kulon Progo Fruit Farm',
                2,
                4,
                [
                    ['Apel Fuji', 'kg', 35000],
                    ['Jeruk Manis', 'kg', 18000],
                    ['Mangga Harum Manis', 'kg', 25000],
                    ['Pisang Raja', 'sisir', 20000],
                    ['Nanas Madu', 'buah', 12000],
                    ['Anggur Merah', 'kg', 45000]
                ]
            ],
            [
                'Rini Agro Lestari',
                2,
                8,
                [
                    ['Semangka Tanpa Biji', 'buah', 25000],
                    ['Pepaya California', 'buah', 12000],
                    ['Melon Hijau', 'buah', 18000],
                    ['Salak Pondoh', 'kg', 12000],
                    ['Jambu Kristal', 'kg', 15000]
                ]
            ],

            [
                'Sumber Daging Gunungkidul',
                3,
                5,
                [
                    ['Daging Sapi Has Dalam', 'kg', 150000],
                    ['Tulang Iga Sapi', 'kg', 120000],
                    ['Daging Kambing Muda', 'kg', 135000],
                    ['Sosis Sapi Homemade', 'pack', 50000],
                    ['Steak Sapi Premium', 'pack', 70000]
                ]
            ],
            [
                'Peternakan Eko Farm',
                3,
                7,
                [
                    ['Ayam Broiler Segar', 'ekor', 40000],
                    ['Paha Ayam Fillet', 'kg', 55000],
                    ['Telur Ayam Kampung', 'butir', 3000],
                    ['Ati Ampela Ayam', 'pack', 15000],
                    ['Dada Ayam Tanpa Tulang', 'kg', 60000]
                ]
            ],
        ];

        foreach ($products as [$business, $categoryId, $supplierId, $items]) {
            foreach ($items as [$name, $unit, $price]) {
                Product::create([
                    'supplier_id' => $supplierId,
                    'category_id' => $categoryId,
                    'name' => $name,
                    'description' => "Produk dari {$business}. {$this->randomDescription()}",
                    'price' => $price,
                    'unit' => $unit,
                    'stock_quantity' => rand(50, 200),
                    'main_image_path' => 'product-images/placeholder.jpg',
                    'is_active' => true,
                    'view_count' => rand(60, 300),
                    'created_at' => now()->subDays(rand(1, 180)),
                ]);
            }
        }
    }

    private function randomDescription(): string
    {
        $templates = [
            'Dikemas segar langsung dari petani lokal.',
            'Cocok untuk kebutuhan dapur harian Anda.',
            'Dijamin segar dan berkualitas tinggi.',
            'Langsung dari kebun ke rumah Anda.',
            'Dipanen dengan standar kebersihan yang tinggi.',
            'Pilihan terbaik untuk makanan sehat.',
            'Produk pilihan hasil panen terbaik.',
            'Tanpa bahan pengawet, alami dan sehat.',
            'Kualitas premium dengan harga terjangkau.',
            'Dipetik dan dikirim di hari yang sama.',
            'Sumber nutrisi alami untuk keluarga Anda.',
            'Dapat digunakan untuk berbagai resep masakan.',
            'Dijaga kesegarannya hingga sampai ke tangan Anda.',
            'Dibudidayakan dengan teknik ramah lingkungan.',
            'Mendukung pertanian lokal Indonesia.',
            'Rasa alami dan tekstur yang lezat.',
            'Cocok untuk konsumsi harian maupun bisnis kuliner.',
            'Bebas pestisida berbahaya.',
            'Dikemas higienis dan siap olah.',
            'Stok terbatas, segera dapatkan sebelum kehabisan!',
            'Diproses dengan standar mutu tinggi.',
            'Pilihan tepat untuk gaya hidup sehat.',
            'Langsung dari peternakan/kebun terpercaya.',
            'Dijamin kesegarannya setiap hari.',
            'Kaya vitamin dan mineral penting.',
            'Mendukung petani dan peternak lokal.',
            'Bisa dipesan dalam jumlah besar untuk kebutuhan usaha.',
            'Produk unggulan dari daerah Yogyakarta.',
            'Dikemas rapi dan aman sampai tujuan.',
            'Cocok untuk menu diet sehat Anda.'
        ];

        return $templates[array_rand($templates)];
    }
}
