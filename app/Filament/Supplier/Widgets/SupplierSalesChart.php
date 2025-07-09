<?php

namespace App\Filament\Supplier\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\Auth;

class SupplierSalesChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Penjualan (30 Hari Terakhir)';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $supplierId = Auth::id();
        $query = Order::query()->whereHas('items.product', fn($q) => $q->where('supplier_id', $supplierId));

        $data = Trend::query($query)
            ->between(
                start: now()->subMonth(),
                end: now(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Pesanan Masuk',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#16a34a',
                    'borderColor' => '#15803d',
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
