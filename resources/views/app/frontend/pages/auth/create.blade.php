@extends('app.frontend.layouts.app')

@section('title', $title ?? 'Masuk ke Akun Anda - Dapur Tani')

@section('content')
    <main class="max-w-5xl mx-auto py-12 md:py-22 my-20">
        <section class="grid lg:grid-cols-2 gap-0 shadow-2xl rounded-lg overflow-hidden">
            <div
                class="hidden lg:flex flex-col justify-between p-12 bg-gradient-to-br from-primary-600 to-primary-700 text-white">
                <div>
                    <a href="{{ route('home') }}" class="flex items-center mb-8">
                        <span class="text-2xl font-extrabold">Dapur Tani</span>
                    </a>
                    <h1 class="text-4xl font-black leading-tight tracking-tight">Gerbang Menuju Rantai Pasok Modern.</h1>
                    <p class="mt-4 text-lg text-primary-100 opacity-90">Bergabunglah dengan ratusan bisnis kuliner dan
                        petani terverifikasi dalam ekosistem kami.</p>
                </div>
                <div class="mt-8">
                    <img src="https://plus.unsplash.com/premium_photo-1664300079079-300447ccd904?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZmFybWVyJTIwc2VsbGluZyUyMHZlZ2V0YWJsZXN8ZW58MHx8MHx8fDA%3D"
                        alt="Ilustrasi Petani dan Pembeli" class="w-full object-fill rounded-lg" loading="lazy">
                </div>
            </div>
            <div class="bg-white p-8 md:p-12" x-data="{ activeTab: '{{ $openTab ?? 'login' }}' }">
                <div class="w-full bg-slate-100 p-1.5 rounded-lg flex items-center mb-8">
                    <button
                        @click="
                            activeTab = 'login';
                            const url = new URL(window.location);
                            url.search = '?o=login';
                            window.history.replaceState({}, '', url);
                            "
                        :class="{ 'bg-primary-600 text-white shadow-md': activeTab === 'login', 'text-slate-500': activeTab !== 'login' }"
                        class="w-1/2 py-2.5 rounded-lg font-bold transition-all duration-300">
                        Masuk
                    </button>
                    <button
                        @click="
                            activeTab = 'register';
                            const url = new URL(window.location);
                            url.search = '?o=register';
                            window.history.replaceState({}, '', url);
                            "
                        :class="{ 'bg-primary-600 text-white shadow-md': activeTab === 'register', 'text-slate-500': activeTab !== 'register' }"
                        class="w-1/2 py-2.5 rounded-lg font-bold transition-all duration-300">
                        Daftar
                    </button>
                </div>
                <div x-show="activeTab === 'login'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0">
                    <h2 class="text-3xl font-extrabold text-dark mb-2">Selamat Datang Kembali!</h2>
                    <p class="text-slate-500 mb-8">Masuk untuk melanjutkan ke dashboard Anda.</p>
                    <form action="{{ route('auth.login') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="login-email" class="font-semibold text-dark">Alamat Email</label>
                            <div class="relative mt-2">
                                <i
                                    class='bx bx-envelope absolute left-4 top-1/2 -translate-y-1/2 text-xl text-slate-400'></i>
                                <input type="email" id="login-email" name="email" placeholder="salman@gmail.com"
                                    class="w-full pl-12 pr-4 py-3 border border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                    value="{{ old('email') }}" required autofocus>
                            </div>
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <div class="flex justify-between items-center">
                                <label for="login-password" class="font-semibold text-dark">Kata
                                    Sandi</label>
                                {{-- <a href="#" class="text-sm font-semibold text-primary-600 hover:underline">Lupa
                        Password?</a> --}}
                            </div>
                            <div class="relative mt-2">
                                <i
                                    class='bx bx-lock-alt absolute left-4 top-1/2 -translate-y-1/2 text-xl text-slate-400'></i>
                                <input type="password" id="login-password" name="password" placeholder="Kata Sandi Anda"
                                    class="w-full pl-12 pr-4 py-3 border border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                    value="{{ old('password') }}" required>
                            </div>
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit"
                            class="w-full bg-primary-600 text-white py-3.5 rounded-lg text-lg font-bold hover:bg-primary-700 transition-colors shadow-lg hover:shadow-primary-300">Masuk</button>
                    </form>
                </div>
                <div x-show="activeTab === 'register'" x-cloak x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0">
                    <h2 class="text-3xl font-extrabold text-dark mb-2">Buat Akun Baru</h2>
                    <p class="text-slate-500 mb-8">Daftar sebagai pembeli untuk mulai memesan.</p>
                    <form action="{{ route('auth.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="register-name" class="font-semibold text-dark">Nama Lengkap</label>
                            <div class="relative mt-2">
                                <i class='bx bx-user absolute left-4 top-1/2 -translate-y-1/2 text-xl text-slate-400'></i>
                                <input type="text" id="register-name" name="name" placeholder="Salman Abdurrahman"
                                    class="w-full pl-12 pr-4 py-3 border border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                    value="{{ old('name') }}" required autofocus>
                            </div>
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="register-email" class="font-semibold text-dark">Alamat Email</label>
                            <div class="relative mt-2">
                                <i
                                    class='bx bx-envelope absolute left-4 top-1/2 -translate-y-1/2 text-xl text-slate-400'></i>
                                <input type="email" id="register-email" name="email" placeholder="salman@gmail.com"
                                    class="w-full pl-12 pr-4 py-3 border border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                    value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="register-password" class="font-semibold text-dark">Kata Sandi</label>
                            <div class="relative mt-2">
                                <i
                                    class='bx bx-lock-alt absolute left-4 top-1/2 -translate-y-1/2 text-xl text-slate-400'></i>
                                <input type="password" id="register-password" name="password"
                                    placeholder="Minimal 8 karakter"
                                    class="w-full pl-12 pr-4 py-3 border border-primary-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                                    value="{{ old('password') }}" required>
                            </div>
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit"
                            class="w-full bg-primary-600 text-white py-3.5 rounded-lg text-lg font-bold hover:bg-primary-700 transition-colors shadow-lg hover:shadow-primary-300">Daftar</button>
                    </form>
                </div>
                <div class="mt-8">
                    <div class="relative flex items-center">
                        <div class="flex-grow border-t border-slate-200"></div>
                        <span class="flex-shrink mx-4 text-slate-400 font-semibold text-sm">atau</span>
                        <div class="flex-grow border-t border-slate-200"></div>
                    </div>
                    <a href="#"
                        class="mt-4 w-full flex items-center justify-center gap-3 border-2 border-slate-200 py-3 rounded-lg hover:bg-slate-50 transition-colors">
                        <svg class="w-6 h-6" viewBox="0 0 48 48">
                            <path fill="#FFC107"
                                d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z">
                            </path>
                            <path fill="#FF3D00"
                                d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z">
                            </path>
                            <path fill="#4CAF50"
                                d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.222,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z">
                            </path>
                            <path fill="#1976D2"
                                d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.574l6.19,5.238C41.38,36.151,44,30.638,44,24C44,22.659,43.862,21.35,43.611,20.083z">
                            </path>
                        </svg>
                        <span class="font-bold text-dark">Masuk dengan Google</span>
                    </a>
                </div>
                <div class="mt-8 text-center">
                    <p class="text-sm">
                        Anda seorang pemasok?
                        <a href="/supplier/login" class="font-bold text-primary-600 hover:underline">Masuk atau Daftar di
                            sini</a>
                    </p>
                </div>
            </div>
        </section>
    </main>
@endsection
