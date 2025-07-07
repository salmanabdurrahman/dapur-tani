<header class="bg-white shadow-sm h-20 flex items-center justify-between px-6 flex-shrink-0">
    <button @click="sidebarOpen = !sidebarOpen" class="text-dark lg:hidden">
        <i class='bx bx-menu text-2xl'></i>
    </button>
    <div class="hidden lg:block"></div>
    <div class="flex items-center gap-4">
        <a href="/produk"
            class="bg-primary-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-primary-700 transition-colors shadow-sm hover:shadow-lg flex items-center gap-2">
            <i class='bx bx-plus-circle text-xl'></i>
            <span>Buat Pesanan Baru</span>
        </a>
        <div class="relative" x-data="{ dropdownOpen: false }">
            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-3">
                <img src="https://i.pravatar.cc/40?u=restoprime" alt="Avatar" class="w-10 h-10 rounded-full"
                    loading="lazy">
                <div class="hidden md:block text-left">
                    <p class="font-bold text-dark text-sm">Resto Prime</p>
                    <p class="text-xs text-slate-500">Buyer Account</p>
                </div>
                <i class='bx bx-chevron-down text-lg text-slate-500'></i>
            </button>
            <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                class="absolute top-full mt-2 right-0 w-48 bg-white rounded-xl shadow-lg border border-slate-100 py-2"
                x-transition>
                <a href="{{ route('home') }}" class="block px-4 py-2 hover:bg-slate-50">Beranda</a>
                <a href="#" class="block px-4 py-2 hover:bg-slate-50">Profil Saya</a>
                <a href="#" class="block px-4 py-2 text-red-500 hover:bg-red-50">Keluar</a>
            </div>
        </div>
    </div>
</header>
