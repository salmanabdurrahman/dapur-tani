<?php

namespace App\Filament\Supplier\Resources\OrderResource\Pages;

use App\Filament\Supplier\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}
