<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the super admin user
        User::create([
            'name' => 'Super Admin',
            'email' => env('ADMIN_EMAIL', ''),
            'password' => bcrypt(env('ADMIN_PASSWORD', '')),
            'role' => UserRole::SUPERADMIN->value,
            'email_verified_at' => now(),
            'status' => 'verified',
            'created_at' => now()->subDays(rand(1, 180)),
        ]);

        // Create supplier users
        $suppliers = [
            [
                'name' => 'Bapak Sutrisno',
                'email' => 'sutrisno@gmail.com',
                'profile' => ['business_name' => 'Tani Makmur Sleman', 'city' => 'Sleman', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Palagan Tentara Pelajar KM 9, Sleman', 'phone_number' => '081234567891', 'bank_name' => 'BCA', 'bank_account_number' => '1234567890', 'bank_account_name' => 'Sutrisno']
            ],
            [
                'name' => 'Ibu Pujiastuti',
                'email' => 'pujiastuti@gmail.com',
                'profile' => ['business_name' => 'Sayur Segar Bantul', 'city' => 'Bantul', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Imogiri Timur KM 12, Bantul', 'phone_number' => '081234567892', 'bank_name' => 'Mandiri', 'bank_account_number' => '0987654321', 'bank_account_name' => 'Pujiastuti']
            ],
            [
                'name' => 'Mas Dono',
                'email' => 'dono@gmail.com',
                'profile' => ['business_name' => 'Kulon Progo Fruit Farm', 'city' => 'Kulon Progo', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Wates KM 15, Kulon Progo', 'phone_number' => '081234567893', 'bank_name' => 'BRI', 'bank_account_number' => '1122334455', 'bank_account_name' => 'Dono']
            ],
            [
                'name' => 'Pakde Karyo',
                'email' => 'karyo@gmail.com',
                'profile' => ['business_name' => 'Sumber Daging Gunungkidul', 'city' => 'Gunungkidul', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Wonosari, Playen, Gunungkidul', 'phone_number' => '081234567894', 'bank_name' => 'BNI', 'bank_account_number' => '5566778899', 'bank_account_name' => 'Karyo']
            ],
            [
                'name' => 'Bu Wati',
                'email' => 'wati@gmail.com',
                'profile' => ['business_name' => 'Wati Fresh Sayur', 'city' => 'Sleman', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Kaliurang KM 10', 'phone_number' => '081234567895', 'bank_name' => 'BCA', 'bank_account_number' => '2233445566', 'bank_account_name' => 'Wati']
            ],
            [
                'name' => 'Mas Eko',
                'email' => 'eko@gmail.com',
                'profile' => ['business_name' => 'Peternakan Eko Farm', 'city' => 'Bantul', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Parangtritis KM 5', 'phone_number' => '081234567896', 'bank_name' => 'Mandiri', 'bank_account_number' => '6677889900', 'bank_account_name' => 'Eko']
            ],
            [
                'name' => 'Mbak Rini',
                'email' => 'rini@gmail.com',
                'profile' => ['business_name' => 'Rini Agro Lestari', 'city' => 'Gunungkidul', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Baron KM 8', 'phone_number' => '081234567897', 'bank_name' => 'BRI', 'bank_account_number' => '3344556677', 'bank_account_name' => 'Rini']
            ],
        ];

        foreach ($suppliers as $supplierData) {
            $user = User::create([
                'name' => $supplierData['name'],
                'email' => $supplierData['email'],
                'password' => Hash::make('password'),
                'role' => UserRole::SUPPLIER->value,
                'status' => 'verified',
                'email_verified_at' => now(),
                'created_at' => now()->subDays(rand(1, 180)),
            ]);
            $user->profile()->create($supplierData['profile']);
        }

        // Create buyer users
        $buyers = [
            [
                'name' => 'Chef Budi',
                'email' => 'budi@resto.com',
                'profile' => ['business_name' => 'Restoran Enak Tenan', 'city' => 'Yogyakarta', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Malioboro No. 123', 'phone_number' => '085678912345']
            ],
            [
                'name' => 'Rina (Manager)',
                'email' => 'rina@hotel.com',
                'profile' => ['business_name' => 'Hotel Tentrem', 'city' => 'Yogyakarta', 'province' => 'DI Yogyakarta', 'address' => 'Jl. AM Sangaji No. 72A', 'phone_number' => '085678912346']
            ],
            [
                'name' => 'Andi (Katering)',
                'email' => 'andi@katering.com',
                'profile' => ['business_name' => 'Katering Berkah', 'city' => 'Sleman', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Gejayan, Condongcatur', 'phone_number' => '085678912347']
            ],
            [
                'name' => 'Sari (Cafe)',
                'email' => 'sari@cafe.com',
                'profile' => ['business_name' => 'Kopi Senja', 'city' => 'Bantul', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Bantul KM 7', 'phone_number' => '085678912348']
            ],
            [
                'name' => 'Bayu (Chef)',
                'email' => 'bayu@kuliner.com',
                'profile' => ['business_name' => 'Dapoer Bayu', 'city' => 'Sleman', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Magelang KM 6', 'phone_number' => '085678912349']
            ],
            [
                'name' => 'Intan (UMKM)',
                'email' => 'intan@umkm.com',
                'profile' => ['business_name' => 'Warung Intan', 'city' => 'Bantul', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Ringroad Selatan', 'phone_number' => '085678912350']
            ],
            [
                'name' => 'Dwi (Catering)',
                'email' => 'dwi@catering.com',
                'profile' => ['business_name' => 'Catering Harapan', 'city' => 'Yogyakarta', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Colombo', 'phone_number' => '085678912351']
            ],
            [
                'name' => 'Yusuf (Resto)',
                'email' => 'yusuf@resto.com',
                'profile' => ['business_name' => 'Resto Lesehan Yusuf', 'city' => 'Sleman', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Affandi', 'phone_number' => '085678912352']
            ],
            [
                'name' => 'Maya (Cafe)',
                'email' => 'maya@cafe.com',
                'profile' => ['business_name' => 'Cafe Kopi Maya', 'city' => 'Gunungkidul', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Pathuk', 'phone_number' => '085678912353']
            ],
            [
                'name' => 'Hadi (Pengusaha)',
                'email' => 'hadi@usaha.com',
                'profile' => ['business_name' => 'Usaha Hadi Jaya', 'city' => 'Kulon Progo', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Wates Barat', 'phone_number' => '085678912354']
            ],
            [
                'name' => 'Rina (Resto)',
                'email' => 'rina2@resto.com',
                'profile' => ['business_name' => 'Resto Rina Spesial', 'city' => 'Yogyakarta', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Monjali', 'phone_number' => '085678912355']
            ],
            [
                'name' => 'Tono (Cafe)',
                'email' => 'tono@cafe.com',
                'profile' => ['business_name' => 'Cafe Tono Jaya', 'city' => 'Sleman', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Kaliurang KM 9', 'phone_number' => '085678912356']
            ],
        ];

        foreach ($buyers as $buyerData) {
            $user = User::create([
                'name' => $buyerData['name'],
                'email' => $buyerData['email'],
                'password' => Hash::make('password'),
                'role' => UserRole::BUYER,
                'status' => 'verified',
                'email_verified_at' => now(),
                'created_at' => now()->subDays(rand(1, 180)),
            ]);
            $user->profile()->create($buyerData['profile']);
        }
    }
}
