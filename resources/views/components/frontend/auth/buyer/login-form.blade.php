<div x-show="activeTab === 'login'" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0">
    <h2 class="text-3xl font-extrabold text-dark mb-2">Selamat Datang Kembali!</h2>
    <p class="text-slate-500 mb-8">Masuk untuk melanjutkan ke dashboard Anda.</p>
    <form action="#" method="POST" class="space-y-5">
        <div>
            <label for="login-email" class="font-semibold text-dark">Alamat Email</label>
            <div class="relative mt-2">
                <i class='bx bx-envelope absolute left-4 top-1/2 -translate-y-1/2 text-xl text-slate-400'></i>
                <input type="email" id="login-email" placeholder="contoh@bisnis.com"
                    class="w-full pl-12 pr-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                    required autofocus>
            </div>
        </div>
        <div>
            <div class="flex justify-between items-center">
                <label for="login-password" class="font-semibold text-dark">Password</label>
                {{-- <a href="#" class="text-sm font-semibold text-primary-600 hover:underline">Lupa
                        Password?</a> --}}
            </div>
            <div class="relative mt-2">
                <i class='bx bx-lock-alt absolute left-4 top-1/2 -translate-y-1/2 text-xl text-slate-400'></i>
                <input type="password" id="login-password" placeholder="••••••••"
                    class="w-full pl-12 pr-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                    required>
            </div>
        </div>
        <button type="submit"
            class="w-full bg-primary-600 text-white py-3.5 rounded-lg text-lg font-bold hover:bg-primary-700 transition-colors shadow-lg hover:shadow-primary-300">Masuk</button>
    </form>
</div>
