<?php

namespace App\Filament\Supplier\Widgets;

use App\Enums\OrderStatus;
use App\Filament\Supplier\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentOrders extends BaseWidget
{
    protected static ?string $heading = 'Pesanan Terbaru';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                OrderResource::getEloquentQuery()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('ID Pesanan'),
                Tables\Columns\TextColumn::make('buyer.name')
                    ->label('Nama Pembeli'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn($state): string => match ($state instanceof OrderStatus ? $state->value : $state) {
                        OrderStatus::PENDING_PAYMENT->value => 'gray',
                        OrderStatus::PROCESSING->value => 'warning',
                        OrderStatus::SHIPPED->value => 'info',
                        OrderStatus::COMPLETED->value => 'success',
                        OrderStatus::CANCELLED->value => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat Detail')
                    ->url(fn(Order $record): string => OrderResource::getUrl('view', ['record' => $record])),
            ]);
    }
}
