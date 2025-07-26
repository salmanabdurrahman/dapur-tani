@extends('app.buyer.layouts.app')

@section('title', 'Langganan Saya - Dapur Tani')

@section('content')
    <section class="mb-8">
        <h1 class="text-3xl font-extrabold text-dark">Langganan Saya</h1>
        <p class="text-slate-500 mt-1">Atur pesanan rutin Anda untuk pengadaan yang lebih efisien.</p>
    </section>
    <section class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 mb-4">
            <h2 class="text-xl font-bold text-dark">Daftar Langganan Aktif</h2>
            <a href="{{ route('products.index') }}"
                class="bg-primary-600 text-white font-bold px-4 py-2.5 rounded-lg hover:bg-primary-700 transition-colors flex items-center gap-2">
                <i class='bx bx-plus-circle text-xl'></i>
                <span>Tambah Langganan Baru</span>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="text-sm text-slate-500 font-semibold border-b-2 border-slate-200">
                    <tr>
                        <th class="p-4">Produk</th>
                        <th class="p-4">Kuantitas</th>
                        <th class="p-4">Jadwal</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recurringOrders as $recurringOrder)
                        @php
                            $translation = [
                                'monday' => 'Senin',
                                'tuesday' => 'Selasa',
                                'wednesday' => 'Rabu',
                                'thursday' => 'Kamis',
                                'friday' => 'Jumat',
                                'saturday' => 'Sabtu',
                                'sunday' => 'Minggu',
                            ];
                        @endphp

                        <tr class="border-b border-slate-100 last:border-b-0">
                            <td class="p-4">
                                <div class="flex items-center gap-4">
                                    <img src="{{ Storage::url($recurringOrder->product->main_image_path) }}"
                                        alt="{{ $recurringOrder->product->name }}"
                                        class="w-16 h-16 object-cover rounded-lg">
                                    <span class="font-semibold text-dark">{{ $recurringOrder->product->name }}</span>
                                </div>
                            </td>
                            <td class="p-4 text-slate-600">{{ $recurringOrder->quantity }}
                                {{ $recurringOrder->product->unit }}</td>
                            <td class="p-4 text-slate-600">
                                Setiap Hari
                                {{ $translation[strtolower($recurringOrder->day_of_week)] ?? $recurringOrder->day_of_week }}
                            </td>
                            <td class="p-4">
                                <form action="{{ route('buyer.recurring-orders.destroy', $recurringOrder) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 font-semibold hover:underline">Batalkan</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center p-16 text-slate-500">
                                <div class="flex flex-col items-center">
                                    <i class='bx bx-calendar-x text-6xl text-slate-300'></i>
                                    <p class="mt-4 font-semibold">Anda belum memiliki langganan aktif.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
