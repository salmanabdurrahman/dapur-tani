<?php

namespace App\Filament\Supplier\Resources\OrderResource\Widgets;

use App\Enums\OrderStatus;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class OrderStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $supplierId = Auth::id();
        $query = Order::query()->whereHas('items.product', fn(Builder $q) => $q->where('supplier_id', $supplierId));

        return [
            Stat::make('Total Pesanan', $query->clone()
                ->count()),
            Stat::make('Pesanan Perlu Diproses', $query->clone()
                ->where('status', OrderStatus::PROCESSING)
                ->count())
                ->color('warning'),
            Stat::make('Pesanan Selesai', $query->clone()
                ->where('status', OrderStatus::COMPLETED)
                ->count())
                ->color('success'),
        ];
    }
}
