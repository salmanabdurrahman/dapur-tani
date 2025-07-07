@extends('app.frontend.layouts.app')

@section('title', 'Hubungi Tim Kami - Dapur Tani')

@section('content')
    <main class="pt-20">
        <section class="relative py-24 md:py-32">
            <div class="container mx-auto px-4 text-center">
                <div class="max-w-3xl mx-auto">
                    <p class="font-semibold text-primary-600 text-lg">Hubungi Kami</p>
                    <h1 class="text-4xl md:text-6xl font-black text-dark mt-2 leading-tight tracking-tight">
                        Kami Siap Membantu Anda
                    </h1>
                    <p class="mt-6 text-lg text-slate-600 max-w-2xl mx-auto">
                        Punya pertanyaan, kritik, saran, atau ingin berkolaborasi? Jangan ragu untuk menghubungi tim kami
                        melalui form di bawah atau detail kontak yang tersedia.
                    </p>
                </div>
            </div>
        </section>
        <section class="pb-24">
            <div class="container mx-auto px-4">
                <div class="grid lg:grid-cols-12 gap-12">
                    <div class="lg:col-span-5">
                        <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-200 h-full">
                            <h2 class="text-2xl font-bold text-dark mb-6">Informasi Kontak</h2>
                            <div class="space-y-6">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="bg-primary-50 text-primary-600 w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <i class='bx bxs-map text-2xl'></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-dark">Alamat Kantor</h3>
                                        <p class="text-slate-600">Jl. Ring Road Utara, Condongcatur, Depok, Sleman,
                                            Yogyakarta 55283</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div
                                        class="bg-primary-50 text-primary-600 w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <i class='bx bxs-envelope text-2xl'></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-dark">Email</h3>
                                        <a href="mailto:halo@dapurtani.com"
                                            class="text-slate-600 hover:text-primary-600 transition-colors">halo@dapurtani.com</a>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div
                                        class="bg-primary-50 text-primary-600 w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <i class='bx bxs-phone text-2xl'></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-dark">Telepon</h3>
                                        <p class="text-slate-600">(0274) 123-456</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div
                                        class="bg-primary-50 text-primary-600 w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <i class='bx bxs-time-five text-2xl'></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-dark">Jam Kerja</h3>
                                        <p class="text-slate-600">Senin - Jumat: 08:00 - 17:00 WIB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-7">
                        <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-200">
                            <h2 class="text-2xl font-bold text-dark mb-1">Kirimkan Pesan</h2>
                            <p class="text-slate-500 mb-6">Tim kami akan merespon pesan Anda secepatnya.</p>
                            <form action="#" method="POST" class="space-y-5">
                                <div class="grid sm:grid-cols-2 gap-5">
                                    <div>
                                        <label for="name" class="font-semibold text-dark">Nama Lengkap</label>
                                        <input type="text" id="name" placeholder="John Doe"
                                            class="mt-2 w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                            required autofocus>
                                    </div>
                                    <div>
                                        <label for="email" class="font-semibold text-dark">Alamat Email</label>
                                        <input type="email" id="email" placeholder="contoh@bisnis.com"
                                            class="mt-2 w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                            required>
                                    </div>
                                </div>
                                <div>
                                    <label for="subject" class="font-semibold text-dark">Subjek</label>
                                    <input type="text" id="subject" placeholder="Contoh: Penawaran Kerjasama"
                                        class="mt-2 w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                        required>
                                </div>
                                <div>
                                    <label for="message" class="font-semibold text-dark">Pesan Anda</label>
                                    <textarea id="message" rows="5" placeholder="Tuliskan pesan Anda di sini..."
                                        class="mt-2 w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                        required></textarea>
                                </div>
                                <button type="submit"
                                    class="w-full bg-primary-600 text-white py-3.5 rounded-lg text-lg font-bold hover:bg-primary-700 transition-colors shadow-lg hover:shadow-primary-300">Kirim
                                    Pesan</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="pb-24">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <h2 class="text-4xl font-extrabold text-dark">Pertanyaan yang Sering Diajukan</h2>
                    <p class="mt-4 text-slate-600">Temukan jawaban cepat untuk pertanyaan umum di bawah ini.</p>
                </div>
                <div class="max-w-3xl mx-auto space-y-4" x-data="{ active: 1 }">
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
                        <button @click="active = (active === 1) ? null : 1"
                            class="w-full flex justify-between items-center text-left p-6">
                            <span class="font-bold text-lg text-dark">Bagaimana cara menjadi pemasok di Dapur Tani?</span>
                            <i class='bx bx-chevron-down text-2xl transition-transform'
                                :class="{ 'rotate-180': active === 1 }"></i>
                        </button>
                        <div x-show="active === 1" x-collapse class="px-6 pb-6 text-slate-600">
                            <p>Anda dapat mendaftar melalui halaman "Jadi Pemasok" di navigasi kami. Tim kami akan segera
                                menghubungi Anda untuk proses verifikasi lebih lanjut. Kami mencari mitra petani dan pemasok
                                yang berkomitmen pada kualitas dan standar terbaik.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
                        <button @click="active = (active === 2) ? null : 2"
                            class="w-full flex justify-between items-center text-left p-6">
                            <span class="font-bold text-lg text-dark">Apa saja area jangkauan pengiriman Dapur Tani?</span>
                            <i class='bx bx-chevron-down text-2xl transition-transform'
                                :class="{ 'rotate-180': active === 2 }"></i>
                        </button>
                        <div x-show="active === 2" x-collapse class="px-6 pb-6 text-slate-600">
                            <p>Saat ini, kami fokus melayani area DI Yogyakarta dan sekitarnya. Namun, kami terus berupaya
                                untuk memperluas jangkauan layanan kami ke kota-kota besar lainnya di Indonesia. Pantau
                                terus informasi terbaru dari kami!</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
                        <button @click="active = (active === 3) ? null : 3"
                            class="w-full flex justify-between items-center text-left p-6">
                            <span class="font-bold text-lg text-dark">Bagaimana sistem pembayaran untuk pembeli?</span>
                            <i class='bx bx-chevron-down text-2xl transition-transform'
                                :class="{ 'rotate-180': active === 3 }"></i>
                        </button>
                        <div x-show="active === 3" x-collapse class="px-6 pb-6 text-slate-600">
                            <p>Kami menyediakan berbagai metode pembayaran yang aman dan mudah, termasuk transfer bank,
                                virtual account, dan e-wallet. Untuk mitra bisnis terverifikasi, kami juga menyediakan opsi
                                pembayaran dengan termin (Term of Payment).</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
