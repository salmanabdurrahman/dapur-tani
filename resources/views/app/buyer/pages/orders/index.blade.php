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
                    <button @click="activeTab = 'semua'"
                        :class="{ 'border-primary-600 text-primary-600': activeTab === 'semua', 'border-transparent text-slate-500 hover:text-dark': activeTab !== 'semua' }"
                        class="whitespace-nowrap py-4 px-1 border-b-4 font-bold transition-colors">Semua</button>
                    <button @click="activeTab = 'diproses'"
                        :class="{ 'border-primary-600 text-primary-600': activeTab === 'diproses', 'border-transparent text-slate-500 hover:text-dark': activeTab !== 'diproses' }"
                        class="whitespace-nowrap py-4 px-1 border-b-4 font-bold transition-colors">Diproses</button>
                    <button @click="activeTab = 'dikirim'"
                        :class="{ 'border-primary-600 text-primary-600': activeTab === 'dikirim', 'border-transparent text-slate-500 hover:text-dark': activeTab !== 'dikirim' }"
                        class="whitespace-nowrap py-4 px-1 border-b-4 font-bold transition-colors">Dikirim</button>
                    <button @click="activeTab = 'selesai'"
                        :class="{ 'border-primary-600 text-primary-600': activeTab === 'selesai', 'border-transparent text-slate-500 hover:text-dark': activeTab !== 'selesai' }"
                        class="whitespace-nowrap py-4 px-1 border-b-4 font-bold transition-colors">Selesai</button>
                </nav>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200" x-show="activeTab === 'semua'">
            <h2 class="text-xl font-bold text-dark mb-4">Semua Pesanan</h2>
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
                        <tr class="border-b border-slate-100 last:border-b-0">
                            <td class="p-4 font-semibold text-dark">#DP-12345</td>
                            <td class="p-4 text-slate-600">5 Juli 2025</td>
                            <td class="p-4 font-semibold text-dark">Rp 1.250.000</td>
                            <td class="p-4"><span
                                    class="bg-sky-100 text-sky-600 font-semibold px-3 py-1 text-xs rounded-full">Dikirim</span>
                            </td>
                            <td class="p-4"><a href="#"
                                    class="text-primary-600 font-semibold hover:underline">Lihat Detail</a></td>
                        </tr>
                        <tr class="border-b border-slate-100 last:border-b-0">
                            <td class="p-4 font-semibold text-dark">#DP-12344</td>
                            <td class="p-4 text-slate-600">3 Juli 2025</td>
                            <td class="p-4 font-semibold text-dark">Rp 875.000</td>
                            <td class="p-4"><span
                                    class="bg-primary-100 text-primary-600 font-semibold px-3 py-1 text-xs rounded-full">Selesai</span>
                            </td>
                            <td class="p-4"><a href="#"
                                    class="text-primary-600 font-semibold hover:underline">Lihat Detail</a></td>
                        </tr>
                        <tr class="border-b border-slate-100 last:border-b-0">
                            <td class="p-4 font-semibold text-dark">#DP-12343</td>
                            <td class="p-4 text-slate-600">2 Juli 2025</td>
                            <td class="p-4 font-semibold text-dark">Rp 450.000</td>
                            <td class="p-4"><span
                                    class="bg-amber-100 text-amber-600 font-semibold px-3 py-1 text-xs rounded-full">Diproses</span>
                            </td>
                            <td class="p-4"><a href="#"
                                    class="text-primary-600 font-semibold hover:underline">Lihat Detail</a></td>
                        </tr>
                        <tr class="border-b border-slate-100 last:border-b-0">
                            <td class="p-4 font-semibold text-dark">#DP-12341</td>
                            <td class="p-4 text-slate-600">30 Juni 2025</td>
                            <td class="p-4 font-semibold text-dark">Rp 300.000</td>
                            <td class="p-4"><span
                                    class="bg-red-100 text-red-600 font-semibold px-3 py-1 text-xs rounded-full">Dibatalkan</span>
                            </td>
                            <td class="p-4"><a href="#"
                                    class="text-primary-600 font-semibold hover:underline">Lihat Detail</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <nav class="mt-6 pt-6 border-t border-slate-200 flex justify-between items-center">
                <p class="text-sm text-slate-500">Menampilkan 1-4 dari 20 pesanan</p>
                <div class="flex items-center gap-2">
                    <a href="#"
                        class="flex items-center justify-center px-3 h-8 text-sm font-medium text-slate-500 bg-white border border-slate-300 rounded-lg hover:bg-slate-100">Sebelumnya</a>
                    <a href="#"
                        class="flex items-center justify-center px-3 h-8 text-sm font-medium text-slate-500 bg-white border border-slate-300 rounded-lg hover:bg-slate-100">Berikutnya</a>
                </div>
            </nav>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200" x-show="activeTab === 'diproses'">
            <h2 class="text-xl font-bold text-dark mb-4">Pesanan Diproses</h2>
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
                        <tr class="border-b border-slate-100 last:border-b-0">
                            <td class="p-4 font-semibold text-dark">#DP-12343</td>
                            <td class="p-4 text-slate-600">2 Juli 2025</td>
                            <td class="p-4 font-semibold text-dark">Rp 450.000</td>
                            <td class="p-4"><span
                                    class="bg-amber-100 text-amber-600 font-semibold px-3 py-1 text-xs rounded-full">Diproses</span>
                            </td>
                            <td class="p-4"><a href="#"
                                    class="text-primary-600 font-semibold hover:underline">Lihat Detail</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <nav class="mt-6 pt-6 border-t border-slate-200 flex justify-between items-center">
                <p class="text-sm text-slate-500">Menampilkan 1-4 dari 20 pesanan</p>
                <div class="flex items-center gap-2">
                    <a href="#"
                        class="flex items-center justify-center px-3 h-8 text-sm font-medium text-slate-500 bg-white border border-slate-300 rounded-lg hover:bg-slate-100">Sebelumnya</a>
                    <a href="#"
                        class="flex items-center justify-center px-3 h-8 text-sm font-medium text-slate-500 bg-white border border-slate-300 rounded-lg hover:bg-slate-100">Berikutnya</a>
                </div>
            </nav>
        </div>
    </section>
@endsection
