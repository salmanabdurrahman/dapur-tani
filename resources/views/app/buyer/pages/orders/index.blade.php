@extends('app.buyer.layouts.app')

@section('title', 'Pesanan Saya - Dapur Tani')

@section('content')
    <section class="mb-8">
        <h1 class="text-3xl font-extrabold text-dark">Pesanan Saya</h1>
        <p class="text-slate-500 mt-1">Lacak dan kelola semua riwayat transaksi Anda di sini.</p>
    </section>
    <section x-data="{ activeTab: 'semua' }">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div class="border-b border-slate-200">
                <nav class="-mb-px flex space-x-6 overflow-x-auto">
                    <a href="{{ route('buyer.orders.index') }}"
                        class="whitespace-nowrap py-4 px-1 border-b-4 font-bold transition-colors 
                       {{ !request('status') ? 'border-primary-600 text-primary-600' : 'border-transparent text-slate-500 hover:text-dark' }}">
                        Semua
                    </a>
                    <a href="{{ route('buyer.orders.index', ['status' => 'processing']) }}"
                        class="whitespace-nowrap py-4 px-1 border-b-4 font-bold transition-colors
                       {{ request('status') == 'processing' ? 'border-primary-600 text-primary-600' : 'border-transparent text-slate-500 hover:text-dark' }}">
                        Diproses
                    </a>
                    <a href="{{ route('buyer.orders.index', ['status' => 'shipped']) }}"
                        class="whitespace-nowrap py-4 px-1 border-b-4 font-bold transition-colors
                       {{ request('status') == 'shipped' ? 'border-primary-600 text-primary-600' : 'border-transparent text-slate-500 hover:text-dark' }}">
                        Dikirim
                    </a>
                    <a href="{{ route('buyer.orders.index', ['status' => 'completed']) }}"
                        class="whitespace-nowrap py-4 px-1 border-b-4 font-bold transition-colors
                       {{ request('status') == 'completed' ? 'border-primary-600 text-primary-600' : 'border-transparent text-slate-500 hover:text-dark' }}">
                        Selesai
                    </a>
                    <a href="{{ route('buyer.orders.index', ['status' => 'cancelled']) }}"
                        class="whitespace-nowrap py-4 px-1 border-b-4 font-bold transition-colors
                       {{ request('status') == 'cancelled' ? 'border-primary-600 text-primary-600' : 'border-transparent text-slate-500 hover:text-dark' }}">
                        Dibatalkan
                    </a>
                </nav>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="text-sm text-slate-500 font-semibold border-b-2 border-slate-200">
                        <tr>
                            <th class="p-4">ID Pesanan</th>
                            <th class="p-4">Tanggal</th>
                            <th class="p-4">Total</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr class="border-b border-slate-100 last:border-b-0">
                                <td class="p-4 font-semibold text-dark">{{ $order->order_number }}</td>
                                <td class="p-4 text-slate-600">{{ $order->created_at->format('d F Y') }}</td>
                                <td class="p-4 font-semibold text-dark">Rp
                                    {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td class="p-4">
                                    <span @class([
                                        'font-semibold px-3 py-1 text-xs rounded-full',
                                        'bg-amber-100 text-amber-600' =>
                                            $order->status === \App\Enums\OrderStatus::PROCESSING,
                                        'bg-sky-100 text-sky-600' =>
                                            $order->status === \App\Enums\OrderStatus::SHIPPED,
                                        'bg-primary-100 text-primary-600' =>
                                            $order->status === \App\Enums\OrderStatus::COMPLETED,
                                        'bg-red-100 text-red-600' =>
                                            $order->status === \App\Enums\OrderStatus::CANCELLED,
                                        'bg-slate-100 text-slate-600' =>
                                            $order->status === \App\Enums\OrderStatus::PENDING_PAYMENT,
                                    ])>
                                        {{ Str::title(str_replace('_', ' ', $order->status->value)) }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <a href="{{ route('buyer.orders.show', $order) }}"
                                        class="text-primary-600 font-semibold hover:underline">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-16 text-slate-500">
                                    <div class="flex flex-col items-center">
                                        <i class='bx bx-package text-6xl text-slate-300'></i>
                                        <p class="mt-4 font-semibold">Tidak ada pesanan dengan status ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($orders->hasPages())
                <nav class="mt-6 pt-6 border-t border-slate-200">
                    {{ $orders->links() }}
                </nav>
            @endif
        </div>
    </section>
@endsection
