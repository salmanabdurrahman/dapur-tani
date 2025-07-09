<?php

namespace App\Filament\Supplier\Resources\PayoutResource\Pages;

use App\Filament\Supplier\Resources\PayoutResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePayout extends CreateRecord
{
    protected static string $resource = PayoutResource::class;

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['supplier_id'] = Auth::id();
        $data['status'] = 'pending';

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
