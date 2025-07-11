@extends('app.buyer.layouts.app')

@section('title', 'Dashboard - Dapur Tani')

@section('content')
    <section class="mb-8">
        <h1 class="text-3xl font-extrabold text-dark">Selamat Datang, {{ auth()->user()->name }}!</h1>
        <p class="text-slate-500 mt-1">Berikut adalah ringkasan aktivitas akun Anda hari ini.</p>
    </section>
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 flex items-center gap-6">
            <div class="bg-primary-100 text-primary-600 w-16 h-16 rounded-2xl flex items-center justify-center">
                <i class='bx bxs-package text-3xl'></i>
            </div>
            <div>
                <p class="text-slate-500">Pesanan Aktif</p>
                <p class="text-3xl font-extrabold text-dark">{{ $activeOrdersCount }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 flex items-center gap-6">
            <div class="bg-sky-100 text-sky-600 w-16 h-16 rounded-2xl flex items-center justify-center"><i
                    class='bx bxs-truck text-3xl'></i></div>
            <div>
                <p class="text-slate-500">Menunggu Pengiriman</p>
                <p class="text-3xl font-extrabold text-dark">{{ $processingOrdersCount }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 flex items-center gap-6">
            <div class="bg-amber-100 text-amber-600 w-16 h-16 rounded-2xl flex items-center justify-center">
                <i class='bx bxs-wallet text-3xl'></i>
            </div>
            <div>
                <p class="text-slate-500">Total Belanja Bulan Ini</p>
                <p class="text-3xl font-extrabold text-dark">Rp {{ number_format($monthlySpending, 0, ',', '.') }}</p>
            </div>
        </div>
    </section>
    <section class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <h2 class="text-xl font-bold text-dark mb-4">Pesanan Terbaru</h2>
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
                    @forelse ($recentOrders as $order)
                        <tr class="border-b border-slate-100">
                            <td class="p-4 font-semibold text-dark">{{ $order->order_number }}</td>
                            <td class="p-4">{{ $order->created_at->format('d F Y') }}</td>
                            <td class="p-4 font-semibold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td class="p-4">
                                <span @class([
                                    'font-semibold px-3 py-1 text-xs rounded-full',
                                    'bg-amber-100 text-amber-600' =>
                                        $order->status === \App\Enums\OrderStatus::PROCESSING,
                                    'bg-sky-100 text-sky-600' =>
                                        $order->status === \App\Enums\OrderStatus::SHIPPED,
                                    'bg-blue-100 text-blue-700' =>
                                        $order->status === \App\Enums\OrderStatus::DELIVERED,
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
                                    class="text-primary-600 font-semibold hover:underline">Lihat
                                    Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-8 text-slate-500">
                                Anda belum memiliki pesanan terbaru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
