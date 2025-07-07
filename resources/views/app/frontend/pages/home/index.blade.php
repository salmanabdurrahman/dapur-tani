@extends('app.frontend.layouts.app')

@section('title', 'Platform Pasokan Pangan B2B untuk Bisnis Kuliner - Dapur Tani')

@push('styles')
    <style>
        .marquee-container {
            overflow: hidden;
            position: relative;
        }

        .marquee-content {
            display: flex;
            width: max-content;
            animation: marquee 45s linear infinite;
        }

        .marquee-content:hover {
            animation-play-state: paused;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }
    </style>
@endpush

@section('content')
    <main class="pt-20">
        <section class="py-16 md:py-24">
            <div class="container mx-auto px-4 text-center">
                <div class="mx-auto max-w-3xl">
                    <h1 class="text-dark text-4xl leading-tight font-black tracking-tight md:text-6xl">
                        Temukan Pasokan <span class="text-primary-600">Segar & Berkualitas</span> untuk Bisnis Anda
                    </h1>
                    <p class="mx-auto mt-6 max-w-2xl text-lg text-slate-600">
                        Dapur Tani adalah jembatan digital antara bisnis kuliner Anda dengan petani dan pemasok
                        terverifikasi di seluruh Indonesia.
                    </p>
                </div>
                <div class="mx-auto mt-10 max-w-2xl">
                    <form method="POST" class="relative">
                        @csrf
                        <input type="text" placeholder="Cari produk apa hari ini? (misal: Tomat Ceri)"
                            class="focus:ring-primary-500 focus:border-primary-500 w-full rounded-xl border-2 border-primary-300 py-4 pr-36 pl-5 text-lg shadow-sm focus:outline-primary-500"
                            required />
                        <button type="submit"
                            class="bg-primary-600 hover:bg-primary-700 absolute inset-y-0 right-2.5 my-2.5 rounded-lg px-6 text-lg font-semibold text-white transition-colors">
                            Cari
                        </button>
                    </form>
                </div>
            </div>
        </section>
        <section class="container mx-auto px-4">
            <div class="flex justify-center gap-3 md:gap-4">
                <a href="#"
                    class="flex w-1/4 flex-col items-center justify-center gap-2 rounded-xl bg-white p-4 shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg md:w-auto lg:flex-row lg:justify-start lg:p-3 lg:pr-5">
                    <div class="bg-primary-50 rounded-lg p-3">
                        <svg class="text-primary-600 h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                    </div>
                    <span class="text-dark text-xs font-semibold lg:text-base">Sayuran</span>
                </a>
                <a href="#"
                    class="flex w-1/4 flex-col items-center justify-center gap-2 rounded-xl bg-white p-4 shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg md:w-auto lg:flex-row lg:justify-start lg:p-3 lg:pr-5">
                    <div class="rounded-lg bg-red-50 p-3">
                        <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m1.5 0h1.5m-1.5 0p-6 0m3 0v-4.5m3 4.5v-4.5m2.25-1.5V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5" />
                        </svg>
                    </div>
                    <span class="text-dark text-xs font-semibold lg:text-base">Daging</span>
                </a>
                <a href="#"
                    class="flex w-1/4 flex-col items-center justify-center gap-2 rounded-xl bg-white p-4 shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg md:w-auto lg:flex-row lg:justify-start lg:p-3 lg:pr-5">
                    <div class="rounded-lg bg-amber-50 p-3">
                        <svg class="h-8 w-8 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12.75 19.5v-.75a7.5 7.5 0 0 0-7.5-7.5H4.5m0-6.75h.75c7.28 0 13.125 5.845 13.125 13.125v.75A1.5 1.5 0 0 1 17.25 21H6.75a1.5 1.5 0 0 1-1.5-1.5v-.75a3.375 3.375 0 0 1 3.375-3.375H9.375" />
                        </svg>
                    </div>
                    <span class="text-dark text-xs font-semibold lg:text-base">Buah</span>
                </a>
                <a href="#"
                    class="flex w-1/4 flex-col items-center justify-center gap-2 rounded-xl bg-white p-4 shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg md:w-auto lg:flex-row lg:justify-start lg:p-3 lg:pr-5">
                    <div class="rounded-lg bg-sky-50 p-3">
                        <svg class="h-8 w-8 text-sky-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.092 1.21-.138 2.43-.138 3.662v.513a5.25 5.25 0 0 0 5.25 5.25h1.5a5.25 5.25 0 0 0 5.25-5.25v-.513Z" />
                        </svg>
                    </div>
                    <span class="text-dark text-xs font-semibold lg:text-base">Lainnya</span>
                </a>
            </div>
        </section>
        <section class="py-24">
            <div class="container mx-auto px-4">
                <div class="mx-auto mb-16 max-w-3xl text-center">
                    <h2 class="text-dark text-4xl font-extrabold">Kenapa Dapur Tani?</h2>
                    <p class="mt-4 text-slate-600">
                        Kami bukan sekadar marketplace. Kami adalah partner pertumbuhan bisnis Anda.
                    </p>
                </div>
                <div class="grid gap-8 text-center md:grid-cols-3">
                    <div class="rounded-2xl bg-white p-8 shadow-sm">
                        <div
                            class="bg-primary-50 text-primary-600 mx-auto flex h-16 w-16 items-center justify-center rounded-2xl">
                            <svg class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h3 class="text-dark mt-6 text-xl font-bold">Kualitas Terverifikasi</h3>
                        <p class="mt-2 text-slate-600">
                            Setiap pemasok telah melalui proses verifikasi ketat untuk menjamin kualitas dan standar
                            produk terbaik.
                        </p>
                    </div>
                    <div class="rounded-2xl bg-white p-8 shadow-sm">
                        <div
                            class="bg-primary-50 text-primary-600 mx-auto flex h-16 w-16 items-center justify-center rounded-2xl">
                            <svg class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h3 class="text-dark mt-6 text-xl font-bold">Harga Transparan</h3>
                        <p class="mt-2 text-slate-600">
                            Dapatkan harga jujur langsung dari sumbernya tanpa biaya tersembunyi atau potongan
                            perantara yang merugikan.
                        </p>
                    </div>
                    <div class="rounded-2xl bg-white p-8 shadow-sm">
                        <div
                            class="bg-primary-50 text-primary-600 mx-auto flex h-16 w-16 items-center justify-center rounded-2xl">
                            <svg class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125V14.25m-17.25 4.5v-1.875a3.375 3.375 0 0 1 3.375-3.375h1.5a1.125 1.125 0 0 1 1.125 1.125v-1.5a3.375 3.375 0 0 1 3.375-3.375H15M12 9v-3.375c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625V9" />
                            </svg>
                        </div>
                        <h3 class="text-dark mt-6 text-xl font-bold">Logistik Andal</h3>
                        <p class="mt-2 text-slate-600">
                            Kami memastikan pesanan Anda sampai tepat waktu dengan sistem logistik yang efisien dan
                            dapat dilacak.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-brand-green-light py-24">
            <div class="container mx-auto px-4">
                <div class="mx-auto mb-16 max-w-3xl text-center">
                    <h2 class="text-dark text-4xl font-extrabold">Dirancang Khusus untuk Kebutuhan Anda</h2>
                    <p class="mt-4 text-slate-600">
                        Baik Anda pebisnis kuliner yang mencari efisiensi, maupun petani yang ingin memperluas
                        pasar, kami punya solusinya.
                    </p>
                </div>
                <div class="grid gap-8 lg:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-lg">
                        <div class="mb-6 flex items-center gap-4">
                            <div class="rounded-xl bg-sky-100 p-3 text-sky-600">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h2.24M12 18.75V21m-3.75-3.75V15a3.75 3.75 0 0 1 3.75-3.75h3.75m-3.75 0V5.625A2.625 2.625 0 0 1 12 3v2.25" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-sky-600">UNTUK PEMBELI</p>
                                <h3 class="text-dark text-2xl font-bold">Dapatkan Pasokan Terbaik</h3>
                            </div>
                        </div>
                        <p class="mb-6 text-slate-600">
                            Lelah dengan harga yang tidak stabil dan kualitas yang tidak konsisten? Sederhanakan
                            proses pengadaan Anda bersama kami.
                        </p>
                        <ul class="space-y-3 text-slate-600">
                            <li class="flex items-center gap-3">
                                <svg class="text-primary-600 h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                <span>Akses langsung ke pemasok terverifikasi.</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="text-primary-600 h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                <span>Harga lebih baik dengan memotong perantara.</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="text-primary-600 h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                <span>Pengiriman terjadwal yang bisa diandalkan.</span>
                            </li>
                        </ul>
                        <a href="#"
                            class="mt-8 inline-block rounded-lg bg-sky-600 px-6 py-2.5 font-bold text-white transition-colors hover:bg-sky-700">
                            Mulai Belanja →
                        </a>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-lg">
                        <div class="mb-6 flex items-center gap-4">
                            <div class="rounded-xl bg-amber-100 p-3 text-amber-600">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1-1.814 1.814l-2.489 2.49a.75.75 0 0 1-1.06-1.061l2.49-2.49Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m10.5 21 4.5-4.5M15.75 10.5l4.5-4.5M21 10.5a8.25 8.25 0 1 1-16.5 0 8.25 8.25 0 0 1 16.5 0Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-amber-600">UNTUK PEMASOK</p>
                                <h3 class="text-dark text-2xl font-bold">Tingkatkan Penjualan Anda</h3>
                            </div>
                        </div>
                        <p class="mb-6 text-slate-600">
                            Kesulitan menjangkau pasar yang lebih luas? Dapatkan akses langsung ke ratusan bisnis
                            kuliner yang membutuhkan produk Anda.
                        </p>
                        <ul class="space-y-3 text-slate-600">
                            <li class="flex items-center gap-3">
                                <svg class="text-primary-600 h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                <span>Jangkau pasar B2B yang lebih luas dan stabil.</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="text-primary-600 h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                <span>Dapatkan harga yang adil dan pembayaran tepat waktu.</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="text-primary-600 h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                <span>Kelola pesanan dan stok dengan dashboard canggih.</span>
                            </li>
                        </ul>
                        <a href="#"
                            class="mt-8 inline-block rounded-lg bg-amber-500 px-6 py-2.5 font-bold text-white transition-colors hover:bg-amber-600">
                            Jadi Pemasok →
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section id="testimonial" class="bg-white py-24">
            <div class="container mx-auto px-4">
                <div class="mx-auto mb-16 max-w-2xl text-center">
                    <h2 class="text-dark text-4xl font-extrabold">Kisah Sukses dari Mitra Kami</h2>
                </div>
            </div>
            <div class="marquee-container space-y-8">
                <div class="marquee-content">
                    <!-- Set 1 -->
                    <div class="flex space-x-8 px-4">
                        <div class="w-96 flex-shrink-0 rounded-xl border border-slate-200 bg-slate-50 p-6">
                            <p class="text-slate-600">
                                "Kualitas produknya konsisten dan pengirimannya selalu tepat waktu. Dapur Tani
                                benar-benar mengubah cara kami bekerja."
                            </p>
                            <div class="mt-4 flex items-center">
                                <img src="https://i.pravatar.cc/40?u=1" class="mr-3 h-10 w-10 rounded-full"
                                    loading="lazy" />
                                <div class="text-sm">
                                    <p class="text-dark font-bold">Chef Budi</p>
                                    <p class="text-slate-500">Executive Chef, Hotel Bintang Lima</p>
                                </div>
                            </div>
                        </div>
                        <div class="w-96 flex-shrink-0 rounded-xl border border-slate-200 bg-slate-50 p-6">
                            <p class="text-slate-600">
                                "Akhirnya ada platform yang adil bagi kami para petani. Kami bisa langsung terhubung
                                dengan pasar besar tanpa perantara."
                            </p>
                            <div class="mt-4 flex items-center">
                                <img src="https://i.pravatar.cc/40?u=3" class="mr-3 h-10 w-10 rounded-full"
                                    loading="lazy" />
                                <div class="text-sm">
                                    <p class="text-dark font-bold">Pak Tono</p>
                                    <p class="text-slate-500">Ketua, Kelompok Tani Maju</p>
                                </div>
                            </div>
                        </div>
                        <div class="w-96 flex-shrink-0 rounded-xl border border-slate-200 bg-slate-50 p-6">
                            <p class="text-slate-600">
                                "Manajemen inventaris jadi lebih mudah. Saya bisa prediksi kebutuhan bahan baku
                                dengan lebih akurat sekarang."
                            </p>
                            <div class="mt-4 flex items-center">
                                <img src="https://i.pravatar.cc/40?u=4" class="mr-3 h-10 w-10 rounded-full"
                                    loading="lazy" />
                                <div class="text-sm">
                                    <p class="text-dark font-bold">Chef Rina</p>
                                    <p class="text-slate-500">Owner, Dapur Sehat Cafe</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Set 2 (Duplikat untuk loop) -->
                    <div class="flex space-x-8 px-4">
                        <div class="w-96 flex-shrink-0 rounded-xl border border-slate-200 bg-slate-50 p-6">
                            <p class="text-slate-600">
                                "Kualitas produknya konsisten dan pengirimannya selalu tepat waktu. Dapur Tani
                                benar-benar mengubah cara kami bekerja."
                            </p>
                            <div class="mt-4 flex items-center">
                                <img src="https://i.pravatar.cc/40?u=1" class="mr-3 h-10 w-10 rounded-full"
                                    loading="lazy" />
                                <div class="text-sm">
                                    <p class="text-dark font-bold">Chef Budi</p>
                                    <p class="text-slate-500">Executive Chef, Hotel Bintang Lima</p>
                                </div>
                            </div>
                        </div>
                        <div class="w-96 flex-shrink-0 rounded-xl border border-slate-200 bg-slate-50 p-6">
                            <p class="text-slate-600">
                                "Akhirnya ada platform yang adil bagi kami para petani. Kami bisa langsung terhubung
                                dengan pasar besar tanpa perantara."
                            </p>
                            <div class="mt-4 flex items-center">
                                <img src="https://i.pravatar.cc/40?u=3" class="mr-3 h-10 w-10 rounded-full"
                                    loading="lazy" />
                                <div class="text-sm">
                                    <p class="text-dark font-bold">Pak Tono</p>
                                    <p class="text-slate-500">Ketua, Kelompok Tani Maju</p>
                                </div>
                            </div>
                        </div>
                        <div class="w-96 flex-shrink-0 rounded-xl border border-slate-200 bg-slate-50 p-6">
                            <p class="text-slate-600">
                                "Manajemen inventaris jadi lebih mudah. Saya bisa prediksi kebutuhan bahan baku
                                dengan lebih akurat sekarang."
                            </p>
                            <div class="mt-4 flex items-center">
                                <img src="https://i.pravatar.cc/40?u=4" class="mr-3 h-10 w-10 rounded-full"
                                    loading="lazy" />
                                <div class="text-sm">
                                    <p class="text-dark font-bold">Chef Rina</p>
                                    <p class="text-slate-500">Owner, Dapur Sehat Cafe</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-24">
            <div class="container mx-auto px-4">
                <div
                    class="from-primary-600 to-primary-800 shadow-primary-200 relative overflow-hidden rounded-2xl bg-gradient-to-br p-12 text-center shadow-2xl md:p-20">
                    <h2 class="text-4xl font-extrabold text-white md:text-5xl">
                        Siap Merevolusi Rantai Pasok Anda?
                    </h2>
                    <p class="text-primary-100 mx-auto mt-4 max-w-2xl">
                        Daftar hari ini dan jadilah bagian dari ekosistem pangan masa depan. Gratis, cepat, dan
                        mudah.
                    </p>
                    <div class="mt-8">
                        <a href="#"
                            class="text-primary-600 transform rounded-full bg-white px-10 py-4 text-lg font-bold shadow-lg transition-all duration-300 hover:scale-105 hover:bg-slate-100">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
