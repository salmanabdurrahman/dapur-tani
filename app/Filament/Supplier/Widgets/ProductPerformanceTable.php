<?php

namespace App\Filament\Supplier\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class ProductPerformanceTable extends BaseWidget
{
    protected static ?string $heading = 'Performa Produk';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()->where('supplier_id', Auth::id())
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable(),

                Tables\Columns\TextColumn::make('view_count')
                    ->label('Dilihat')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('orderItems_sum_quantity')
                    ->sum('orderItems', 'quantity')
                    ->label('Terjual')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('revenue')
                    ->label('Total Pendapatan')
                    ->money('IDR')
                    ->state(function (Product $record): float {
                        return $record->orderItems->sum(function ($item) {
                            return $item->quantity * $item->price_per_unit;
                        });
                    }),
            ])
            ->defaultSort('view_count', 'desc');
    }
}
