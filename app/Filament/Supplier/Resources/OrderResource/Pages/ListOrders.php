<?php

namespace App\Filament\Supplier\Resources\OrderResource\Pages;

use App\Enums\OrderStatus;
use App\Filament\Supplier\Resources\OrderResource;
use App\Filament\Supplier\Resources\OrderResource\Widgets\OrderStatsOverview;
use App\Models\Order;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStatsOverview::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $supplierId = Auth::id();

        $tabConfigs = [
            [
                'key' => 'semua',
                'label' => 'Semua Pesanan',
            ],
            [
                'key' => 'menunggu_pembayaran',
                'label' => 'Menunggu Pembayaran',
                'status' => OrderStatus::PENDING_PAYMENT,
                'badgeColor' => 'gray',
            ],
            [
                'key' => 'diproses',
                'label' => 'Perlu Diproses',
                'status' => OrderStatus::PROCESSING,
                'badgeColor' => 'warning',
            ],
            [
                'key' => 'dikirim',
                'label' => 'Dikirim',
                'status' => OrderStatus::SHIPPED,
                'badgeColor' => 'info',
            ],
            [
                'key' => 'diterima',
                'label' => 'Diterima',
                'status' => OrderStatus::DELIVERED,
                'badgeColor' => 'primary',
            ],
            [
                'key' => 'selesai',
                'label' => 'Selesai',
                'status' => OrderStatus::COMPLETED,
                'badgeColor' => 'success',
            ],
            [
                'key' => 'dibatalkan',
                'label' => 'Dibatalkan',
                'status' => OrderStatus::CANCELLED,
                'badgeColor' => 'danger',
            ],
        ];

        $tabs = [];

        foreach ($tabConfigs as $config) {
            $tab = Tab::make($config['label']);

            if (isset($config['status'])) {
                $tab = $tab
                    ->modifyQueryUsing(
                        fn(Builder $query) =>
                        $query->where('status', $config['status'])
                    )
                    ->badge(
                        Order::query()
                            ->whereHas('items.product', fn($q) => $q->where('supplier_id', $supplierId))
                            ->where('status', $config['status'])
                            ->count()
                    )
                    ->badgeColor($config['badgeColor']);
            }

            $tabs[$config['key']] = $tab;
        }

        return $tabs;
    }
}
