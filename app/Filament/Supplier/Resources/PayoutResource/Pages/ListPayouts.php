<?php

namespace App\Filament\Supplier\Resources\PayoutResource\Pages;

use App\Filament\Supplier\Resources\PayoutResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListPayouts extends ListRecords
{
    protected static string $resource = PayoutResource::class;

    protected function getHeaderActions(): array
    {
        $profile = Auth::user()->profile;
        $canCreate = $profile && $profile->bank_name && $profile->bank_account_number && $profile->bank_account_name;

        return [
            Actions\CreateAction::make()
                ->disabled(!$canCreate)
                ->tooltip($canCreate ? null : 'Harap lengkapi informasi bank di Pengaturan Profil terlebih dahulu.'),
        ];
    }
}
