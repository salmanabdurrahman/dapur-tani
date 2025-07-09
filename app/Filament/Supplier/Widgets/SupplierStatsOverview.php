<?php

namespace App\Filament\Supplier\Widgets;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupplierStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $supplierId = Auth::id();

        $totalProducts = Product::where('supplier_id', $supplierId)->count();

        $totalRevenue = Order::whereHas('items.product', function ($query) use ($supplierId) {
            $query->where('supplier_id', $supplierId);
        })
            ->where('status', OrderStatus::COMPLETED)
            ->sum('total_amount');

        $newOrders = Order::whereHas('items.product', function ($query) use ($supplierId) {
            $query->where('supplier_id', $supplierId);
        })
            ->where('status', OrderStatus::PROCESSING)
            ->count();

        $averageRating = DB::table('reviews')
            ->join('products', 'reviews.product_id', '=', 'products.id')
            ->where('products.supplier_id', $supplierId)
            ->avg('reviews.rating');

        $bestSeller = Product::where('supplier_id', $supplierId)
            ->withCount('orderItems as sales_count')
            ->orderByDesc('sales_count')
            ->first();

        return [
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Dari semua pesanan selesai')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Pesanan Baru', $newOrders)
                ->description('Perlu segera diproses')
                ->descriptionIcon('heroicon-m-inbox')
                ->color('warning'),
            Stat::make('Jumlah Produk Aktif', $totalProducts)
                ->description('Produk yang sedang dijual')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('info'),
            Stat::make('Produk Terlaris', $bestSeller->name ?? 'Belum ada')
                ->description($bestSeller ? ($bestSeller->sales_count . ' unit terjual') : '')
                ->color('info'),
            Stat::make('Rating Rata-rata', number_format($averageRating, 1))
                ->description('Dari semua ulasan produk')
                ->descriptionIcon('heroicon-m-star')
                ->color('success'),
        ];
    }
}
