<?php

namespace Database\Seeders;

use App\Enums\UserRole;
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
        User::create([
            'name' => 'Super Admin',
            'email' => env('ADMIN_EMAIL', ''),
            'password' => bcrypt(env('ADMIN_PASSWORD', '')),
            'role' => UserRole::SUPERADMIN->value,
            'email_verified_at' => now(),
            'status' => 'verified',
        ]);
    }
}
