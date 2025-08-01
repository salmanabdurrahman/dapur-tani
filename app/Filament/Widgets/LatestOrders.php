<?php

namespace App\Filament\Widgets;

use App\Enums\OrderStatus;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected static ?string $heading = 'Aktivitas Pesanan Terbaru';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('ID Pesanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('buyer.name')
                    ->label('Nama Pembeli')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(OrderStatus $state): string => match ($state->value) {
                        OrderStatus::PENDING_PAYMENT->value => 'gray',
                        OrderStatus::PROCESSING->value => 'warning',
                        OrderStatus::SHIPPED->value => 'info',
                        OrderStatus::COMPLETED->value => 'success',
                        OrderStatus::CANCELLED->value => 'danger',
                        default => 'gray',
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->url(fn(Order $record): string => "/admin/orders/{$record->id}")
            ])
            ->paginated(false);
    }
}
