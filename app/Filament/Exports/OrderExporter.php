<?php

namespace App\Filament\Exports;

use App\Models\Order;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Database\Eloquent\Builder;

class OrderExporter extends Exporter
{
    protected static ?string $model = Order::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('order_number')
                ->label('ID Pesanan'),
            ExportColumn::make('buyer.name')
                ->label('Nama Pembeli'),
            ExportColumn::make('created_at')
                ->label('Tanggal Pesan'),
            ExportColumn::make('status'),
            ExportColumn::make('total_amount')
                ->label('Total Pembayaran'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your order export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    public function getFileName(Export $export): string
    {
        return "Laporan-Pesanan-{$export->getKey()}";
    }

    public function getEloquentQuery(): Builder
    {
        return Order::query()
            ->whereHas('items.product', function (Builder $query) {
                $query->where('supplier_id', Auth::id());
            });
    }
}
