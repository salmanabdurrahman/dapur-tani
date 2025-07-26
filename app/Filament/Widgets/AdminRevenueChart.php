<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Setting;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class AdminRevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pendapatan Platform (12 Bulan Terakhir)';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $commissionRate = (float) (Setting::where('key', 'platform_commission')
            ->first()?->value ?? 10) / 100;

        $data = Trend::model(Order::class)
            ->between(start: now()->subYear(), end: now())
            ->perMonth()
            ->sum('total_amount');

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan Platform',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate * $commissionRate),
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
