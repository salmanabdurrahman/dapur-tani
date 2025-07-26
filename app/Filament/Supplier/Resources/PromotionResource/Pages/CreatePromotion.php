<?php

namespace App\Filament\Supplier\Resources\PromotionResource\Pages;

use App\Filament\Supplier\Resources\PromotionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePromotion extends CreateRecord
{
    protected static string $resource = PromotionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['supplier_id'] = Auth::id();
        return $data;
    }
}
