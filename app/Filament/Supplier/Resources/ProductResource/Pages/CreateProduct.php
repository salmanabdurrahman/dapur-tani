<?php

namespace App\Filament\Supplier\Resources\ProductResource\Pages;

use App\Filament\Supplier\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
