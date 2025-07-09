<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Payout;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalBuyers = User::where('role', 'buyer')->count();
        $totalSuppliers = User::where('role', 'supplier')->count();

        $completedOrders = Order::where('status', 'completed')->count();

        $pendingPayouts = Payout::where('status', 'pending')->count();

        return [
            Stat::make('Total Pembeli', $totalBuyers)
                ->description('Pengguna yang terdaftar sebagai pembeli')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('success'),
            Stat::make('Total Pemasok', $totalSuppliers)
                ->description('Pengguna yang terdaftar sebagai pemasok')
                ->descriptionIcon('heroicon-m-truck')
                ->color('info'),
            Stat::make('Pesanan Selesai', $completedOrders)
                ->description('Total transaksi yang telah selesai')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
            Stat::make('Permintaan Payout', $pendingPayouts)
                ->description('Permintaan yang perlu diproses')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('warning'),
        ];
    }
}
