<?php

namespace App\Filament\Supplier\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ProductPerformanceTable extends BaseWidget
{
    protected static ?string $heading = 'Performa Produk';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 5;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->where('supplier_id', Auth::id())
                    ->withSum('orderItems', 'quantity')
                    ->withCount('orderItems')
                    ->with('orderItems')
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('view_count')
                    ->label('Dilihat')
                    ->numeric()
                    ->sortable()
                    ->default(0),

                Tables\Columns\TextColumn::make('order_items_sum_quantity')
                    ->label('Terjual')
                    ->numeric()
                    ->sortable()
                    ->default(0),

                Tables\Columns\TextColumn::make('order_items_count')
                    ->label('Total Order')
                    ->numeric()
                    ->sortable()
                    ->default(0),

                Tables\Columns\TextColumn::make('revenue')
                    ->label('Total Pendapatan')
                    ->money('IDR')
                    ->state(function (Product $record): float {
                        return $record->orderItems->sum(function ($item) {
                            return $item->quantity * $item->price_per_unit;
                        });
                    })
                    ->sortable(false),
            ])
            ->defaultSort('view_count', 'desc')
            ->filters([
                Tables\Filters\Filter::make('has_orders')
                    ->label('Punya Pesanan')
                    ->query(fn(Builder $query): Builder => $query->has('orderItems')),
            ]);
    }
}
