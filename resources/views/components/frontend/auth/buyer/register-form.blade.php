<div x-show="activeTab === 'register'" x-cloak x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0">
    <h2 class="text-3xl font-extrabold text-dark mb-2">Buat Akun Baru</h2>
    <p class="text-slate-500 mb-8">Daftar sebagai pembeli untuk mulai memesan.</p>
    <form action="#" class="space-y-5">
        <div>
            <label for="register-name" class="font-semibold text-dark">Nama Lengkap</label>
            <div class="relative mt-2">
                <i class='bx bx-user absolute left-4 top-1/2 -translate-y-1/2 text-xl text-slate-400'></i>
                <input type="text" id="register-name" placeholder="John Doe"
                    class="w-full pl-12 pr-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                    required autofocus>
            </div>
        </div>
        <div>
            <label for="register-email" class="font-semibold text-dark">Alamat Email</label>
            <div class="relative mt-2">
                <i class='bx bx-envelope absolute left-4 top-1/2 -translate-y-1/2 text-xl text-slate-400'></i>
                <input type="email" id="register-email" placeholder="contoh@bisnis.com"
                    class="w-full pl-12 pr-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                    required>
            </div>
        </div>
        <div>
            <label for="register-password" class="font-semibold text-dark">Password</label>
            <div class="relative mt-2">
                <i class='bx bx-lock-alt absolute left-4 top-1/2 -translate-y-1/2 text-xl text-slate-400'></i>
                <input type="password" id="register-password" placeholder="Minimal 8 karakter"
                    class="w-full pl-12 pr-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"
                    required>
            </div>
        </div>
        <button type="submit"
            class="w-full bg-primary-600 text-white py-3.5 rounded-lg text-lg font-bold hover:bg-primary-700 transition-colors shadow-lg hover:shadow-primary-300">Daftar</button>
    </form>
</div>
