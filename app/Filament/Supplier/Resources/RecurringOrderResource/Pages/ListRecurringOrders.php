<?php

namespace App\Filament\Supplier\Resources\RecurringOrderResource\Pages;

use App\Filament\Supplier\Resources\RecurringOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRecurringOrders extends ListRecords
{
    protected static string $resource = RecurringOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
