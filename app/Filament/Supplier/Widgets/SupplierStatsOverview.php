<?php

namespace App\Filament\Supplier\Widgets;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

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
        ];
    }
}
