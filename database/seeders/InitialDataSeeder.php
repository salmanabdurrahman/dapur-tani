<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the super admin user
        User::updateOrCreate([
            'name' => 'Super Admin',
            'email' => env('ADMIN_EMAIL', ''),
            'password' => bcrypt(env('ADMIN_PASSWORD', '')),
            'role' => UserRole::SUPERADMIN->value,
            'email_verified_at' => now(),
            'status' => 'verified',
        ]);

        // Create the default categories
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
            Category::updateOrCreate($category);
        }
    }
}
