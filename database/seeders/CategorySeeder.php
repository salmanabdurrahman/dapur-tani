<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sayuran Segar',
                'slug' => 'sayuran-segar',
                'description' => 'Beragam sayuran segar langsung dari petani lokal, siap memenuhi kebutuhan nutrisi harian Anda.'
            ],
            [
                'name' => 'Buah-buahan',
                'slug' => 'buah-buahan',
                'description' => 'Pilihan buah-buahan berkualitas dengan rasa manis alami, segar, dan menyehatkan.'
            ],
            [
                'name' => 'Daging dan Unggas',
                'slug' => 'daging-dan-unggas',
                'description' => 'Daging sapi, ayam, dan unggas segar yang diproses secara higienis untuk keluarga Anda.'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
