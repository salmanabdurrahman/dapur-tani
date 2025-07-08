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
                <p class="text-3xl font-extrabold text-dark">3</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 flex items-center gap-6">
            <div class="bg-sky-100 text-sky-600 w-16 h-16 rounded-2xl flex items-center justify-center"><i
                    class='bx bxs-truck text-3xl'></i></div>
            <div>
                <p class="text-slate-500">Menunggu Pengiriman</p>
                <p class="text-3xl font-extrabold text-dark">1</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 flex items-center gap-6">
            <div class="bg-amber-100 text-amber-600 w-16 h-16 rounded-2xl flex items-center justify-center">
                <i class='bx bxs-wallet text-3xl'></i>
            </div>
            <div>
                <p class="text-slate-500">Total Belanja Bulan Ini</p>
                <p class="text-3xl font-extrabold text-dark">Rp 5.2Jt</p>
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
                    <tr class="border-b border-slate-100">
                        <td class="p-4 font-semibold text-dark">#DP-12345</td>
                        <td class="p-4">5 Juli 2025</td>
                        <td class="p-4 font-semibold">Rp 1.250.000</td>
                        <td class="p-4"><span
                                class="bg-sky-100 text-sky-600 font-semibold px-3 py-1 text-sm rounded-full">Dikirim</span>
                        </td>
                        <td class="p-4"><a href="#" class="text-primary-600 font-semibold hover:underline">Lihat
                                Detail</a>
                        </td>
                    </tr>
                    <tr class="border-b border-slate-100">
                        <td class="p-4 font-semibold text-dark">#DP-12344</td>
                        <td class="p-4">3 Juli 2025</td>
                        <td class="p-4 font-semibold">Rp 875.000</td>
                        <td class="p-4"><span
                                class="bg-primary-100 text-primary-600 font-semibold px-3 py-1 text-sm rounded-full">Selesai</span>
                        </td>
                        <td class="p-4"><a href="#" class="text-primary-600 font-semibold hover:underline">Lihat
                                Detail</a>
                        </td>
                    </tr>
                    <tr class="border-b border-slate-100">
                        <td class="p-4 font-semibold text-dark">#DP-12342</td>
                        <td class="p-4">1 Juli 2025</td>
                        <td class="p-4 font-semibold">Rp 2.100.000</td>
                        <td class="p-4"><span
                                class="bg-primary-100 text-primary-600 font-semibold px-3 py-1 text-sm rounded-full">Selesai</span>
                        </td>
                        <td class="p-4"><a href="#" class="text-primary-600 font-semibold hover:underline">Lihat
                                Detail</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection
