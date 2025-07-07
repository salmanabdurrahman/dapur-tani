@extends('app.buyer.layouts.app')

@section('title', 'Pengaturan Akun Saya - Dapur Tani')

@section('content')
    <section class="mb-8">
        <h1 class="text-3xl font-extrabold text-dark">Pengaturan Akun</h1>
        <p class="text-slate-500 mt-1">Kelola informasi profil, alamat, dan keamanan akun Anda.</p>
    </section>
    <section x-data="{ activeTab: 'profil' }">
        <div class="border-b border-slate-200 mb-8">
            <nav class="-mb-px flex space-x-6 overflow-x-auto">
                <button @click="activeTab = 'profil'"
                    :class="{ 'border-primary-600 text-primary-600': activeTab === 'profil', 'border-transparent text-slate-500 hover:text-dark': activeTab !== 'profil' }"
                    class="whitespace-nowrap py-4 px-1 border-b-4 font-bold transition-colors">Profil Bisnis</button>
                <button @click="activeTab = 'alamat'"
                    :class="{ 'border-primary-600 text-primary-600': activeTab === 'alamat', 'border-transparent text-slate-500 hover:text-dark': activeTab !== 'alamat' }"
                    class="whitespace-nowrap py-4 px-1 border-b-4 font-bold transition-colors">Alamat Pengiriman</button>
                <button @click="activeTab = 'keamanan'"
                    :class="{ 'border-primary-600 text-primary-600': activeTab === 'keamanan', 'border-transparent text-slate-500 hover:text-dark': activeTab !== 'keamanan' }"
                    class="whitespace-nowrap py-4 px-1 border-b-4 font-bold transition-colors">Keamanan</button>
            </nav>
        </div>
        <div>
            <div x-show="activeTab === 'profil'" x-transition>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                    <h2 class="text-xl font-bold text-dark">Informasi Profil Bisnis</h2>
                    <p class="text-slate-500 mt-1 mb-6">Pastikan informasi ini sesuai dengan data bisnis Anda.</p>
                    <form action="#" method="POST" class="space-y-6">
                        <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                            <label class="block font-semibold text-dark">Foto Profil / Logo Bisnis</label>
                            <div class="mt-2 flex items-center">
                                <span class="inline-block h-20 w-20 rounded-full overflow-hidden bg-slate-100">
                                    <template x-if="photoPreview">
                                        <img :src="photoPreview" class="h-full w-full object-cover">
                                    </template>
                                    <template x-if="!photoPreview">
                                        <svg class="h-full w-full text-slate-300" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z">
                                            </path>
                                        </svg>
                                    </template>
                                </span>
                                <input type="file" class="hidden" x-ref="photo"
                                    @change="photoName = $refs.photo.files[0].name; const reader = new FileReader(); reader.onload = (e) => { photoPreview = e.target.result; }; reader.readAsDataURL($refs.photo.files[0]);">
                                <button type="button" @click="$refs.photo.click()"
                                    class="ml-5 bg-white py-2 px-4 border border-slate-300 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-50">Ganti
                                    Foto</button>
                            </div>
                        </div>
                        <div>
                            <label for="business_name" class="font-semibold text-dark">Nama Bisnis</label>
                            <input type="text" id="business_name" value="Resto Prime"
                                class="mt-2 w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                        </div>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="contact_name" class="font-semibold text-dark">Nama Kontak (PIC)</label>
                                <input type="text" id="contact_name" value="John Doe"
                                    class="mt-2 w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            <div>
                                <label for="email" class="font-semibold text-dark">Alamat Email</label>
                                <input type="email" id="email" value="resto.prime@example.com"
                                    class="mt-2 w-full px-4 py-3 border-2 border-slate-200 rounded-lg bg-slate-100 cursor-not-allowed"
                                    readonly>
                            </div>
                        </div>
                        <div>
                            <label for="phone_number" class="font-semibold text-dark">Nomor Telepon / WhatsApp</label>
                            <input type="tel" id="phone_number" value="081234567890"
                                class="mt-2 w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                        </div>
                        <div class="text-right pt-4 border-t border-slate-200">
                            <button type="submit"
                                class="bg-primary-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-primary-700 transition-colors shadow-sm hover:shadow-lg">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div x-show="activeTab === 'alamat'" x-transition>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                    <h2 class="text-xl font-bold text-dark">Alamat Pengiriman Utama</h2>
                    <p class="text-slate-500 mt-1 mb-6">Alamat ini akan digunakan sebagai alamat default untuk semua pesanan
                        Anda.</p>
                    <form action="#" method="POST" class="space-y-6">
                        <div>
                            <label for="address" class="font-semibold text-dark">Alamat Lengkap</label>
                            <textarea id="address" rows="4" placeholder="Contoh: Jl. Kaliurang KM 5.5, Gg. Pandega, No. 123"
                                class="mt-2 w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500">Jl. Kaliurang KM 5.5, Gg. Pandega, No. 123</textarea>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="city" class="font-semibold text-dark">Kota / Kabupaten</label>
                                <input type="text" id="city" value="Sleman"
                                    class="mt-2 w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            <div>
                                <label for="province" class="font-semibold text-dark">Provinsi</label>
                                <input type="text" id="province" value="DI Yogyakarta"
                                    class="mt-2 w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                            </div>
                        </div>
                        <div class="text-right pt-4 border-t border-slate-200">
                            <button type="submit"
                                class="bg-primary-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-primary-700 transition-colors shadow-sm hover:shadow-lg">Simpan
                                Alamat</button>
                        </div>
                    </form>
                </div>
            </div>
            <div x-show="activeTab === 'keamanan'" x-transition>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                    <h2 class="text-xl font-bold text-dark">Ganti Password</h2>
                    <p class="text-slate-500 mt-1 mb-6">Untuk keamanan akun, ganti password Anda secara berkala.</p>
                    <form action="#" method="POST" class="space-y-6 max-w-lg">
                        <div>
                            <label for="current_password" class="font-semibold text-dark">Password Saat Ini</label>
                            <input type="password" id="current_password"
                                class="mt-2 w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                        </div>
                        <div>
                            <label for="new_password" class="font-semibold text-dark">Password Baru</label>
                            <input type="password" id="new_password"
                                class="mt-2 w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                        </div>
                        <div>
                            <label for="confirm_password" class="font-semibold text-dark">Konfirmasi Password Baru</label>
                            <input type="password" id="confirm_password"
                                class="mt-2 w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                        </div>
                        <div class="text-right pt-4 border-t border-slate-200">
                            <button type="submit"
                                class="bg-primary-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-primary-700 transition-colors shadow-sm hover:shadow-lg">Ganti
                                Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
