<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrdersExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection(): Builder
    {
        return Order::query()
            ->whereHas('items.product', function ($query) {
                $query->where('supplier_id', Auth::id());
            })
            ->with(['buyer']);
    }

    public function headings(): array
    {
        return [
            'ID Pesanan',
            'Nama Pembeli',
            'Tanggal Pesan',
            'Status',
            'Total Pembayaran',
        ];
    }

    public function map($order): array
    {
        return [
            $order->order_number,
            $order->buyer->name,
            $order->created_at->format('d-m-Y H:i'),
            $order->status->value,
            $order->total_amount,
        ];
    }
}
