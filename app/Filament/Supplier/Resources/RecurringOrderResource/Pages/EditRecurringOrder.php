<?php

namespace App\Filament\Supplier\Resources\RecurringOrderResource\Pages;

use App\Filament\Supplier\Resources\RecurringOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRecurringOrder extends EditRecord
{
    protected static string $resource = RecurringOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
