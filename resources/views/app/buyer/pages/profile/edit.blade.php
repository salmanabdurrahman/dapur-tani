@extends('app.buyer.layouts.app')

@section('title', 'Pengaturan Akun Saya - Dapur Tani')

@section('content')
    <section class="mb-8">
        <h1 class="text-3xl font-extrabold text-dark">Pengaturan Akun</h1>
        <p class="text-slate-500 mt-1">Kelola informasi profil, alamat, keamanan akun, dan detail bank Anda.</p>
    </section>
    <section x-data="{ activeTab: '{{ old('tab', $openTab) }}' }">
        <div class="border-b border-slate-200 mb-8">
            <nav class="-mb-px flex space-x-6 overflow-x-auto">
                <button
                    @click="
                        activeTab = 'profile';
                        const url = new URL(window.location);
                        url.search = '?tab=profile';
                        window.history.replaceState({}, '', url);
                        "
                    :class="{ 'border-primary-600 text-primary-600': activeTab === 'profile', 'border-transparent text-slate-500 hover:text-dark': activeTab !== 'profile' }"
                    class="whitespace-nowrap py-4 px-1 border-b-4 font-bold transition-colors">Profil Bisnis</button>
                <button
                    @click="
                        activeTab = 'address';
                        const url = new URL(window.location);
                        url.search = '?tab=address';
                        window.history.replaceState({}, '', url);
                        "
                    :class="{ 'border-primary-600 text-primary-600': activeTab === 'address', 'border-transparent text-slate-500 hover:text-dark': activeTab !== 'address' }"
                    class="whitespace-nowrap py-4 px-1 border-b-4 font-bold transition-colors">Alamat Pengiriman</button>
                <button
                    @click="
                        activeTab = 'security';
                        const url = new URL(window.location);
                        url.search = '?tab=security';
                        window.history.replaceState({}, '', url);
                        "
                    :class="{ 'border-primary-600 text-primary-600': activeTab === 'security', 'border-transparent text-slate-500 hover:text-dark': activeTab !== 'security' }"
                    class="whitespace-nowrap py-4 px-1 border-b-4 font-bold transition-colors">Keamanan</button>
                <button
                    @click="
                        activeTab = 'bank';
                        const url = new URL(window.location);
                        url.search = '?tab=bank';
                        window.history.replaceState({}, '', url);
                        "
                    :class="{ 'border-primary-600 text-primary-600': activeTab === 'bank', 'border-transparent text-slate-500 hover:text-dark': activeTab !== 'bank' }"
                    class="whitespace-nowrap py-4 px-1 border-b-4 font-bold transition-colors">Detail Bank</button>
            </nav>
        </div>
        <div>
            <div x-show="activeTab === 'profile'" x-transition>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                    <h2 class="text-xl font-bold text-dark">Informasi Profil Bisnis</h2>
                    <p class="text-slate-500 mt-1 mb-6">Pastikan informasi ini sesuai dengan data bisnis Anda.</p>
                    <form action="{{ route('buyer.settings.updateProfile') }}" method="POST" class="space-y-6"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                            <label class="block font-semibold text-dark">Foto Profil / Logo Bisnis</label>
                            <div class="mt-2 flex items-center">
                                <span class="inline-block h-20 w-20 rounded-full overflow-hidden bg-slate-100">
                                    <template x-if="photoPreview">
                                        <img :src="photoPreview" class="h-full w-full object-cover" loading="lazy">
                                    </template>
                                    <template x-if="!photoPreview">
                                        <svg class="h-full w-full text-slate-300" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z">
                                            </path>
                                        </svg>
                                    </template>
                                </span>
                                <input type="file" class="hidden" x-ref="photo" name="photo" accept="image/*"
                                    @change="
                                        if ($refs.photo.files[0]) {
                                            photoName = $refs.photo.files[0].name; 
                                            const reader = new FileReader(); 
                                            reader.onload = (e) => { photoPreview = e.target.result; }; 
                                            reader.readAsDataURL($refs.photo.files[0]);
                                        }
                                    ">
                                <button type="button" @click="$refs.photo.click()"
                                    class="ml-5 bg-white py-2 px-4 border border-slate-300 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-50">Ganti
                                    Foto</button>
                            </div>
                            @error('photo')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="business_name" class="font-semibold text-dark">Nama Bisnis</label>
                            <input type="text" id="business_name" name="business_name"
                                value="{{ old('business_name', $user->profile->business_name ?? '') }}"
                                class="mt-2 w-full px-4 py-3 border border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                placeholder="Resto Prime" required autofocus>
                            @error('business_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="contact_name" class="font-semibold text-dark">Nama Kontak (PIC)</label>
                                <input type="text" id="contact_name" name="contact_name"
                                    value="{{ old('contact_name', $user->name ?? '') }}"
                                    class="mt-2 w-full px-4 py-3 border border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                    placeholder="Salman Abdurrahman" required>
                                @error('contact_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="font-semibold text-dark">Alamat Email</label>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', $user->email ?? '') }}"
                                    class="mt-2 w-full px-4 py-3 border border-primary-300 rounded-lg bg-slate-100 cursor-not-allowed focus:outline-none"
                                    placeholder="cs@dapurtani.com" readonly>
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="phone_number" class="font-semibold text-dark">Nomor Telepon / WhatsApp</label>
                            <input type="tel" id="phone_number" name="phone_number"
                                value="{{ old('phone_number', $user->profile->phone_number ?? '') }}"
                                class="mt-2 w-full px-4 py-3 border border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                placeholder="081234567890" required>
                            @error('phone_number')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-right pt-4 border-t border-slate-200">
                            <button type="submit"
                                class="bg-primary-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-primary-700 transition-colors shadow-sm hover:shadow-lg">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div x-show="activeTab === 'address'" x-transition>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                    <h2 class="text-xl font-bold text-dark">Alamat Pengiriman Utama</h2>
                    <p class="text-slate-500 mt-1 mb-6">Alamat ini akan digunakan sebagai alamat default untuk semua pesanan
                        Anda.</p>
                    <form action="{{ route('buyer.settings.updateAddress') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="address" class="font-semibold text-dark">Alamat Lengkap</label>
                            <textarea id="address" rows="4" name="address" placeholder="Jl. Kaliurang KM 5.5, Gg. Pandega, No. 123"
                                class="mt-2 w-full px-4 py-3 border border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                required>{{ old('address', $user->profile->address ?? '') }}</textarea>
                            @error('address')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="city" class="font-semibold text-dark">Kota / Kabupaten</label>
                                <input type="text" id="city" name="city"
                                    value="{{ old('city', $user->profile->city ?? '') }}"
                                    class="mt-2 w-full px-4 py-3 border border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                    placeholder="Sleman" required>
                                @error('city')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="province" class="font-semibold text-dark">Provinsi</label>
                                <input type="text" id="province" name="province"
                                    value="{{ old('province', $user->profile->province ?? '') }}"
                                    class="mt-2 w-full px-4 py-3 border border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                    placeholder="DI Yogyakarta" required>
                                @error('province')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
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
            <div x-show="activeTab === 'security'" x-transition>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                    <h2 class="text-xl font-bold text-dark">Ganti Kata Sandi</h2>
                    <p class="text-slate-500 mt-1 mb-6">Untuk keamanan akun, ganti kata sandi Anda secara berkala.</p>
                    <form action="{{ route('buyer.settings.updatePassword') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="current_password" class="font-semibold text-dark">Kata Sandi Saat Ini</label>
                            <input type="password" id="current_password" name="current_password"
                                class="mt-2 w-full px-4 py-3 border border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                value="{{ old('current_password') }}" placeholder="Masukkan kata sandi saat ini"
                                required>
                            @error('current_password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="new_password" class="font-semibold text-dark">Kata Sandi Baru</label>
                            <input type="password" id="new_password" name="new_password"
                                class="mt-2 w-full px-4 py-3 border border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                value="{{ old('new_password') }}" placeholder="Masukkan kata sandi baru" required>
                            @error('new_password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="new_password_confirmation" class="font-semibold text-dark">Konfirmasi Kata Sandi
                                Baru</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                class="mt-2 w-full px-4 py-3 border border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                value="{{ old('new_password_confirmation') }}" placeholder="Konfirmasi kata sandi baru"
                                required>
                            @error('new_password_confirmation')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-right pt-4 border-t border-slate-200">
                            <button type="submit"
                                class="bg-primary-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-primary-700 transition-colors shadow-sm hover:shadow-lg">Ganti
                                Password</button>
                        </div>
                    </form>
                </div>
            </div>
            <div x-show="activeTab === 'bank'" x-transition>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                    <h2 class="text-xl font-bold text-dark">Ganti Detail Bank</h2>
                    <p class="text-slate-500 mt-1 mb-6">Perbarui informasi rekening bank Anda.</p>
                    <form action="{{ route('buyer.settings.updateBankDetails') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="bank_name" class="font-semibold text-dark">Nama Bank</label>
                            <input type="text" id="bank_name" name="bank_name"
                                class="mt-2 w-full px-4 py-3 border border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                value="{{ old('bank_name', $user->profile->bank_name ?? '') }}"
                                placeholder="Masukkan nama bank" required>
                            @error('bank_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="bank_account_number" class="font-semibold text-dark">Nomor Rekening Bank</label>
                            <input type="text" id="bank_account_number" name="bank_account_number"
                                class="mt-2 w-full px-4 py-3 border border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                value="{{ old('bank_account_number', $user->profile->bank_account_number ?? '') }}"
                                placeholder="Masukkan nomor rekening bank" required>
                            @error('bank_account_number')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="bank_account_name" class="font-semibold text-dark">Nama Pemilik Rekening</label>
                            <input type="text" id="bank_account_name" name="bank_account_name"
                                class="mt-2 w-full px-4 py-3 border border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                value="{{ old('bank_account_name', $user->profile->bank_account_name ?? '') }}"
                                placeholder="Masukkan nama pemilik rekening" required>
                            @error('bank_account_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-right pt-4 border-t border-slate-200">
                            <button type="submit"
                                class="bg-primary-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-primary-700 transition-colors shadow-sm hover:shadow-lg">Simpan
                                Detail Bank</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
