@extends('app.frontend.layouts.app')

@section('title', 'Misi Kami: Membangun Ekosistem Pangan yang Adil - Dapur Tani')

@section('content')
    <main class="pt-20">
        <section class="relative py-24 md:py-32 bg-white">
            <div class="container mx-auto px-4 text-center">
                <div class="max-w-3xl mx-auto">
                    <p class="font-semibold text-primary-600 text-lg">Misi Kami</p>
                    <h1 class="text-4xl md:text-6xl font-black text-dark mt-2 leading-tight tracking-tight">
                        Membangun Ekosistem Pangan yang Adil dan Efisien untuk Indonesia
                    </h1>
                    <p class="mt-6 text-lg text-slate-600 max-w-2xl mx-auto">
                        Kami percaya bahwa teknologi dapat menjadi jembatan yang menghubungkan kerja keras para petani
                        dengan kebutuhan industri kuliner, menciptakan pertumbuhan yang berkelanjutan untuk semua.
                    </p>
                </div>
            </div>
        </section>
        <section class="py-24">
            <div class="container mx-auto px-4">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                    <div class="order-2 lg:order-1">
                        <h2 class="text-3xl md:text-4xl font-extrabold text-dark tracking-tight">Cerita di Balik Dapur Tani
                        </h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            Dapur Tani lahir dari sebuah keprihatinan sederhana: rantai pasok pangan di negara kita terlalu
                            panjang, rumit, dan seringkali tidak adil. Di satu sisi, para petani bekerja keras namun
                            hasilnya dihargai rendah. Di sisi lain, para pebisnis kuliner kesulitan mendapatkan pasokan
                            berkualitas dengan harga yang stabil.
                        </p>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            Berangkat dari masalah tersebut, kami, sekelompok anak muda dengan latar belakang teknologi dan
                            agrikultur, bermimpi untuk menciptakan sebuah solusi. Sebuah platform yang memotong semua
                            kerumitan itu. Sebuah tempat di mana transparansi, kualitas, dan keadilan bukan lagi sekadar
                            wacana.
                        </p>
                        <a href="#"
                            class="inline-block mt-8 bg-primary-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-primary-700 transition-colors shadow-sm hover:shadow-lg">
                            Hubungi Kami
                        </a>
                    </div>
                    <div class="order-1 lg:order-2">
                        <img src="https://images.unsplash.com/photo-1543083477-4f785aeafaa9?q=80&w=1200"
                            alt="Diskusi tim Dapur Tani" class="rounded-2xl shadow-2xl w-full" loading="lazy">
                    </div>
                </div>
            </div>
        </section>
        <section class="py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <h2 class="text-4xl font-extrabold text-dark">Prinsip yang Kami Pegang</h2>
                    <p class="mt-4 text-slate-600">Empat pilar yang menjadi fondasi kami dalam membangun Dapur Tani.</p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center p-8">
                        <div
                            class="bg-primary-50 text-primary-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto shadow-lg shadow-primary-100">
                            <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M12 2a9.982 9.982 0 0 0-7.07 2.93L2.998 6.998l2.068 3.582L6.42 8.79l3.078-1.777L12 5.236l2.502 1.777L17.58 8.79l1.354 1.79 2.068-3.582-1.932-2.068A9.982 9.982 0 0 0 12 2zm-5.65 9 1.354 1.79-1.354 1.79-3.078-1.777-2.068-3.582 3.078-1.777zm11.3 0L15.58 8.79l3.078 1.777-2.068 3.582-3.078 1.777-1.354-1.79zm-4.296 6.777L12 19.544l-2.502-1.777-3.078-1.777-1.354 1.79 1.932 2.068A9.982 9.982 0 0 0 12 22a9.982 9.982 0 0 0 7.07-2.93l1.932-2.068-1.354-1.79z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-dark mt-6">Keadilan</h3>
                        <p class="mt-2 text-slate-600">Memastikan setiap petani mendapatkan harga yang pantas atas kerja
                            keras mereka.</p>
                    </div>
                    <div class="text-center p-8">
                        <div
                            class="bg-primary-50 text-primary-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto shadow-lg shadow-primary-100">
                            <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z" />
                                <path fill="currentColor" d="m16.294 8.292-5.292 5.294-2.292-2.294-.708.708 3 3 6-6z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-dark mt-6">Kualitas</h3>
                        <p class="mt-2 text-slate-600">Hanya produk terbaik dari pemasok terverifikasi yang sampai ke dapur
                            Anda.</p>
                    </div>
                    <div class="text-center p-8">
                        <div
                            class="bg-primary-50 text-primary-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto shadow-lg shadow-primary-100">
                            <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M12 2C9.243 2 7 4.243 7 7c0 2.052.744 3.916 2.013 5.317L9 13v3h6v-3l.013-.683A5.986 5.986 0 0 0 17 7c0-2.757-2.243-5-5-5zM9 18h6v2H9z" />
                                <path fill="currentColor"
                                    d="M12 2C9.243 2 7 4.243 7 7c0 2.052.744 3.916 2.013 5.317L9 13v3h6v-3l.013-.683A5.986 5.986 0 0 0 17 7c0-2.757-2.243-5-5-5zM9 18h6v2H9z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-dark mt-6">Inovasi</h3>
                        <p class="mt-2 text-slate-600">Terus mengembangkan teknologi untuk membuat rantai pasok lebih
                            efisien dan transparan.</p>
                    </div>
                    <div class="text-center p-8">
                        <div
                            class="bg-primary-50 text-primary-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto shadow-lg shadow-primary-100">
                            <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M12 21.35-1.45-8.48C9.52-7.51 3.51 1.5 3.51 1.5s3.52 6.01 8.49 19.85z"
                                    transform="translate(1.49 -1.5)" />
                                <path fill="currentColor" d="M20.49 1.5s-6.01 6.01-8.49 7.48L20.49 21.35s0-13.84 0-19.85z"
                                    transform="translate(-1.49 -1.5)" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-dark mt-6">Kemitraan</h3>
                        <p class="mt-2 text-slate-600">Membangun hubungan jangka panjang yang saling menguntungkan dengan
                            semua mitra kami.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="relative bg-dark p-12 md:p-20 rounded-2xl shadow-2xl text-center overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary-600/20 rounded-full filter blur-3xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-primary-600/20 rounded-full filter blur-3xl">
                    </div>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-white">Mari Berkolaborasi!</h2>
                    <p class="mt-4 max-w-2xl mx-auto text-slate-300">Jadilah bagian dari perubahan. Baik sebagai mitra
                        pemasok, pembeli, ataupun bagian dari tim kami. Mari tumbuh bersama Dapur Tani.</p>
                    <div class="mt-8">
                        <a href="#"
                            class="bg-primary-600 text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-primary-500 transition-all duration-300 shadow-2xl transform">
                            Lihat Lowongan
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
