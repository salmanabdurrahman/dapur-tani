<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate(['key' => 'platform_commission'], [
            'value' => '10',
            'label' => 'Komisi Platform (%)',
            'group' => 'keuangan'
        ]);

        Setting::updateOrCreate(['key' => 'minimum_payout'], [
            'value' => '50000',
            'label' => 'Minimum Payout (Rp)',
            'group' => 'keuangan'
        ]);
    }
}
