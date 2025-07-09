<?php

namespace App\Filament\Widgets;

use App\Enums\OrderStatus;
use App\Filament\Resources\PayoutResource;
use App\Filament\Resources\UserResource;
use App\Models\Order;
use App\Models\Payout;
use App\Models\Setting;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $platformCommission = Setting::where('key', 'platform_commission')->first()?->value ?? 0.10;
        $totalRevenue = Order::where('status', OrderStatus::COMPLETED)->sum('total_amount');
        $platformRevenue = $totalRevenue * $platformCommission;

        $newUsersToday = User::where('created_at', '>=', now()->subDay())->count();
        $totalBuyers = User::where('role', 'buyer')->count();
        $totalSuppliers = User::where('role', 'supplier')->count();

        $pendingSuppliers = User::where('role', 'supplier')->where('status', 'pending')->count();
        $pendingPayouts = Payout::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();

        return [
            Stat::make('Total Pendapatan Platform', 'Rp ' . number_format($platformRevenue))
                ->description('Estimasi pendapatan dari komisi')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Pesanan Selesai', $completedOrders)
                ->description('Total transaksi yang telah selesai')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('Supplier Menunggu Verifikasi', $pendingSuppliers)
                ->description('Perlu segera ditinjau')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->url(UserResource::getUrl('index', ['tableFilters[status][value]' => 'pending'])),

            Stat::make('Permintaan Payout', $pendingPayouts)
                ->description('Permintaan yang perlu diproses')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('warning')
                ->url(PayoutResource::getUrl('index', ['tableFilters[status][value]' => 'pending'])),

            Stat::make('Pengguna Baru (24 Jam)', $newUsersToday)
                ->description('Total pendaftar baru hari ini')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('info'),

            Stat::make('Total Pembeli', $totalBuyers)
                ->description('Pengguna yang terdaftar sebagai pembeli')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('success'),

            Stat::make('Total Pemasok', $totalSuppliers)
                ->description('Pengguna yang terdaftar sebagai pemasok')
                ->descriptionIcon('heroicon-m-truck')
                ->color('info'),
        ];
    }
}
