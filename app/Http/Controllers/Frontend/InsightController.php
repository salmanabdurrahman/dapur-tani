<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InsightController extends Controller
{
    public function index(): View
    {
        $popularProducts = Product::query()
            ->where('is_active', true)
            ->withCount('orderItems as sales_count')
            ->orderByDesc('sales_count')
            ->limit(5)
            ->get();

        $trendsData = [];
        $initialChartData = null;

        foreach ($popularProducts as $index => $product) {
            $priceTrend = Trend::query(
                OrderItem::where('product_id', $product->id)
            )
                ->between(start: now()->subMonths(6), end: now())
                ->perMonth()
                ->average('price_per_unit');

            $trendsData[$product->id] = [
                'name' => $product->name,
                'labels' => $priceTrend->map(fn(TrendValue $value) => $value->date),
                'data' => $priceTrend->map(fn(TrendValue $value) => round($value->aggregate)),
            ];

            if ($index === 0) {
                $initialChartData = $trendsData[$product->id];
            }
        }

        if ($initialChartData === null) {
            $initialChartData = [
                'name' => 'Data Belum Tersedia',
                'labels' => [],
                'data' => [],
            ];
        }

        return view('app.frontend.pages.insights.index', compact('popularProducts', 'trendsData', 'initialChartData'));
    }
}
