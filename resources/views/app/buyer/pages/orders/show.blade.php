@extends('app.buyer.layouts.app')

@section('title', 'Detai Pesanan #DP-12345 - Dapur Tani')

@section('content')
    <section class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-dark">Detail Pesanan #DP-12345</h1>
                <p class="text-slate-500 mt-1">Dipesan pada 5 Juli 2025</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="#"
                    class="bg-slate-200 text-dark font-bold px-4 py-2.5 rounded-lg hover:bg-slate-300 transition-colors flex items-center gap-2">
                    <i class='bx bxs-printer text-xl'></i><span>Cetak Invoice</span>
                </a>
                <a href="#"
                    class="bg-primary-600 text-white font-bold px-4 py-2.5 rounded-lg hover:bg-primary-700 transition-colors flex items-center gap-2">
                    <i class='bx bx-revision text-xl'></i><span>Pesan Lagi</span>
                </a>
            </div>
        </div>
    </section>
    <section class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <h2 class="text-xl font-bold text-dark mb-4">Rincian Produk</h2>
                <div class="space-y-4">
                    <div class="flex items-start gap-4 border-b border-slate-100 pb-4">
                        <img src="https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?q=80&w=200" alt="Tomat"
                            class="w-20 h-20 object-cover rounded-lg">
                        <div class="flex-grow">
                            <p class="font-bold text-dark">Tomat Ceri Organik</p>
                            <p class="text-sm text-slate-500">Rp 25.000 x 5 kg</p>
                        </div>
                        <p class="font-semibold text-dark">Rp 125.000</p>
                    </div>
                    <div class="flex items-start gap-4 border-b border-slate-100 pb-4">
                        <img src="https://images.unsplash.com/photo-1587351177733-a037418a3e42?q=80&w=200" alt="Brokoli"
                            class="w-20 h-20 object-cover rounded-lg">
                        <div class="flex-grow">
                            <p class="font-bold text-dark">Brokoli Hidroponik</p>
                            <p class="text-sm text-slate-500">Rp 18.000 x 10 kg</p>
                        </div>
                        <p class="font-semibold text-dark">Rp 180.000</p>
                    </div>
                    <div class="flex items-start gap-4">
                        <img src="https://images.unsplash.com/photo-1628109635955-396a8a18357f?q=80&w=200" alt="Bawang"
                            class="w-20 h-20 object-cover rounded-lg">
                        <div class="flex-grow">
                            <p class="font-bold text-dark">Bawang Merah Brebes</p>
                            <p class="text-sm text-slate-500">Rp 38.000 x 25 kg</p>
                        </div>
                        <p class="font-semibold text-dark">Rp 950.000</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <h2 class="text-xl font-bold text-dark mb-4">Ringkasan Pembayaran</h2>
                <div class="space-y-3 text-slate-600">
                    <div class="flex justify-between"><span>Subtotal</span><span class="font-semibold text-dark">Rp
                            1.255.000</span></div>
                    <div class="flex justify-between"><span>Biaya Pengiriman</span><span class="font-semibold text-dark">Rp
                            25.000</span></div>
                    <div class="flex justify-between"><span>Diskon</span><span class="font-semibold text-primary-600">- Rp
                            30.000</span></div>
                    <div class="flex justify-between pt-4 border-t border-slate-200 text-lg font-bold text-dark"><span>Total
                            Pembayaran</span><span>Rp 1.250.000</span></div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 space-y-6 lg:sticky lg:top-28">
                <div>
                    <h3 class="font-bold text-dark mb-2">Status Pesanan</h3>
                    <div class="bg-sky-100 text-sky-700 font-bold px-4 py-2 rounded-lg flex items-center gap-3">
                        <i class='bx bxs-truck text-2xl'></i>
                        <span>SEDANG DIKIRIM</span>
                    </div>
                </div>
                <div>
                    <h3 class="font-bold text-dark mb-2">Alamat Pengiriman</h3>
                    <div class="text-slate-600 leading-relaxed">
                        <p class="font-semibold">Resto Prime (John Doe)</p>
                        <p>081234567890</p>
                        <p>Jl. Kaliurang KM 5.5, Gg. Pandega, No. 123, Condongcatur, Depok, Sleman, Yogyakarta, 55283</p>
                    </div>
                </div>
                <div>
                    <h3 class="font-bold text-dark mb-2">Lacak Pengiriman</h3>
                    <p class="text-sm text-slate-500 mb-5">No. Resi: <span
                            class="font-semibold text-dark">DPX123456789</span></p>
                    <a href="#"
                        class="w-full text-center bg-slate-200 text-dark font-bold px-4 py-2.5 rounded-lg hover:bg-slate-300 transition-colors">Lacak
                        di Sini</a>
                </div>
            </div>
        </div>
    </section>
@endsection
