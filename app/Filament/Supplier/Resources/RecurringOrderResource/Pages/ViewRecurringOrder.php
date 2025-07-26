<?php

namespace App\Filament\Supplier\Resources\RecurringOrderResource\Pages;

use App\Filament\Supplier\Resources\RecurringOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRecurringOrder extends ViewRecord
{
    protected static string $resource = RecurringOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }
}
