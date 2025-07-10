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
    <main class="pt-20 lg:pt-0">
        <section class="relative flex min-h-screen items-center justify-center bg-primary-50 py-20">
            <div class="container mx-auto px-4 text-center">
                <div class="mx-auto max-w-4xl">
                    <h1 class="text-dark text-5xl leading-tight font-black tracking-tight md:text-7xl">
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
                            class="focus:ring-primary-500 focus:border-primary-500 w-full rounded-xl border border-primary-300 py-4 pr-36 pl-5 text-lg shadow-lg focus:outline-primary-500 bg-white"
                            required />
                        <button type="submit"
                            class="bg-primary-600 hover:bg-primary-700 absolute inset-y-0 right-2.5 my-2.5 rounded-lg px-6 text-lg font-bold text-white transition-colors">
                            Cari
                        </button>
                    </form>
                </div>
            </div>
        </section>
        <section class="flex items-center bg-white py-24">
            <div class="container mx-auto px-4">
                <div class="mx-auto max-w-3xl text-center mb-16">
                    <h2 class="text-4xl font-extrabold text-dark">Mulai dari Kategori</h2>
                    <p class="mt-4 text-slate-600">Pilih kategori untuk melihat semua produk yang relevan dengan kebutuhan
                        bisnis Anda.</p>
                </div>
                <div class="flex flex-wrap justify-center gap-6 md:gap-8">
                    <a href="/products?search=&categories%5B%5D=Sayuran+Segar"
                        class="group flex w-full flex-col items-center justify-center gap-4 rounded-2xl bg-slate-50 p-8 shadow-sm transition-all hover-elevate sm:w-64">
                        <div
                            class="rounded-2xl bg-primary-100 p-5 text-primary-600 transition-colors group-hover:bg-primary-600 group-hover:text-white">
                            <i class='bx bxs-leaf text-5xl'></i>
                        </div>
                        <span class="text-dark text-xl font-bold">Sayuran</span>
                    </a>
                    <a href="/products?search=&categories%5B%5D=Daging+dan+Unggas"
                        class="group flex w-full flex-col items-center justify-center gap-4 rounded-2xl bg-slate-50 p-8 shadow-sm transition-all hover-elevate sm:w-64">
                        <div
                            class="rounded-2xl bg-red-100 p-5 text-red-600 transition-colors group-hover:bg-red-600 group-hover:text-white">
                            <i class='bx bxs-fridge text-5xl'></i>
                        </div>
                        <span class="text-dark text-xl font-bold">Daging</span>
                    </a>
                    <a href="/products?search=&categories%5B%5D=Buah-buahan"
                        class="group flex w-full flex-col items-center justify-center gap-4 rounded-2xl bg-slate-50 p-8 shadow-sm transition-all hover-elevate sm:w-64">
                        <div
                            class="rounded-2xl bg-amber-100 p-5 text-amber-600 transition-colors group-hover:bg-amber-600 group-hover:text-white">
                            <i class='bx bxs-lemon text-5xl'></i>
                        </div>
                        <span class="text-dark text-xl font-bold">Buah</span>
                    </a>
                    <a href="/products?sort=all"
                        class="group flex w-full flex-col items-center justify-center gap-4 rounded-2xl bg-slate-50 p-8 shadow-sm transition-all hover-elevate sm:w-64">
                        <div
                            class="rounded-2xl bg-sky-100 p-5 text-sky-600 transition-colors group-hover:bg-sky-600 group-hover:text-white">
                            <i class='bx bxs-grid-alt text-5xl'></i>
                        </div>
                        <span class="text-dark text-xl font-bold">Lainnya</span>
                    </a>
                </div>
            </div>
        </section>
        <section class="py-24" id="why-choose-us">
            <div class="container mx-auto px-4">
                <div class="mx-auto mb-16 max-w-3xl text-center">
                    <h2 class="text-dark text-4xl font-extrabold">Kenapa Dapur Tani?</h2>
                    <p class="mt-4 text-slate-600">
                        Kami bukan sekadar marketplace. Kami adalah partner pertumbuhan bisnis Anda.
                    </p>
                </div>
                <div class="grid gap-8 text-center md:grid-cols-3">
                    <div class="rounded-2xl bg-white p-8 shadow-sm hover-elevate">
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
                    <div class="rounded-2xl bg-white p-8 shadow-sm hover-elevate">
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
                    <div class="rounded-2xl bg-white p-8 shadow-sm hover-elevate">
                        <div
                            class="bg-primary-50 text-primary-600 mx-auto flex h-16 w-16 items-center justify-center rounded-2xl">
                            <i class='bx bx-car text-4xl'></i>
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
                    <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-lg hover-elevate">
                        <div class="mb-6 flex items-center gap-4">
                            <div class="rounded-xl bg-sky-100 p-3 text-sky-600 items-center justify-center">
                                <i class='bx bx-user text-[32px]'></i>
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
                        <a href="{{ route('products.index') }}"
                            class="mt-8 inline-block rounded-lg bg-sky-600 px-6 py-2.5 font-bold text-white transition-colors hover:bg-sky-700">
                            Mulai Belanja
                        </a>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-lg hover-elevate">
                        <div class="mb-6 flex items-center gap-4">
                            <div class="rounded-xl bg-amber-100 p-3 text-amber-600 items-center justify-center">
                                <i class='bx bx-cart text-[32px]'></i>
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
                        <a href="/supplier/register"
                            class="mt-8 inline-block rounded-lg bg-amber-500 px-6 py-2.5 font-bold text-white transition-colors hover:bg-amber-600">
                            Jadi Pemasok
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
                    <div class="flex space-x-8 px-4">
                        <div
                            class="w-96 flex-shrink-0 rounded-xl border border-slate-200 bg-slate-50 p-6 hover:border-primary-300 hover:shadow-lg">
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
                        <div
                            class="w-96 flex-shrink-0 rounded-xl border border-slate-200 bg-slate-50 p-6 hover:border-primary-300 hover:shadow-lg">
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
                        <div
                            class="w-96 flex-shrink-0 rounded-xl border border-slate-200 bg-slate-50 p-6 hover:border-primary-300 hover:shadow-lg">
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
                    <div class="flex space-x-8 px-4">
                        <div
                            class="w-96 flex-shrink-0 rounded-xl border border-slate-200 bg-slate-50 p-6 hover:border-primary-300 hover:shadow-lg">
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
                        <div
                            class="w-96 flex-shrink-0 rounded-xl border border-slate-200 bg-slate-50 p-6 hover:border-primary-300 hover:shadow-lg">
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
                        <div
                            class="w-96 flex-shrink-0 rounded-xl border border-slate-200 bg-slate-50 p-6 hover:border-primary-300 hover:shadow-lg">
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
                    <div class="flex space-x-8 px-4">
                        <div
                            class="w-96 flex-shrink-0 rounded-xl border border-slate-200 bg-slate-50 p-6 hover:border-primary-300 hover:shadow-lg">
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
                        <div
                            class="w-96 flex-shrink-0 rounded-xl border border-slate-200 bg-slate-50 p-6 hover:border-primary-300 hover:shadow-lg">
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
                        <div
                            class="w-96 flex-shrink-0 rounded-xl border border-slate-200 bg-slate-50 p-6 hover:border-primary-300 hover:shadow-lg">
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
                    class="from-primary-600 to-primary-800 relative overflow-hidden rounded-2xl bg-gradient-to-br p-12 text-center shadow-2xl md:p-20">
                    <h2 class="text-4xl font-extrabold text-white md:text-5xl">
                        Siap Merevolusi Rantai Pasok Anda?
                    </h2>
                    <p class="text-primary-100 mx-auto mt-4 max-w-2xl">
                        Daftar hari ini dan jadilah bagian dari ekosistem pangan masa depan. Gratis, cepat, dan
                        mudah.
                    </p>
                    <div class="mt-8">
                        <a href="{{ route('auth.create', ['o' => 'register']) }}"
                            class="text-primary-600 transform rounded-full bg-white px-10 py-4 text-lg font-bold shadow-lg transition-all duration-300 hover:scale-105 hover:bg-slate-100">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
