<header x-data="{ mobileMenuOpen: false }" class="fixed top-0 z-40 w-full border-b border-slate-200 bg-white/80 backdrop-blur-lg">
    <div class="container mx-auto px-4">
        <div class="flex h-20 items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center">
                <span class="text-primary-600 text-2xl font-extrabold">Dapur Tani</span>
            </a>
            <div class="hidden lg:flex lg:items-center lg:space-x-4">
                <a href="{{ route('home') }}"
                    class="px-3 py-2 font-semibold transition-colors {{ request()->is('/') ? 'text-primary-600' : 'text-dark hover:text-primary-600' }}">Beranda</a>
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <button @click="dropdownOpen = !dropdownOpen"
                        class="flex items-center px-3 py-2 font-semibold transition-colors {{ request()->is('products*') ? 'text-primary-600' : 'text-dark hover:text-primary-600' }}">
                        Kategori
                        <svg :class="{ 'rotate-180': dropdownOpen }" class="ml-1 h-5 w-5 transition-transform"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                        class="absolute top-full mt-2 w-56 rounded-xl border border-slate-100 bg-white py-2 shadow-lg"
                        x-transition>
                        <a href="/products?sort=all"
                            class="hover:text-primary-600 block px-4 py-2 hover:bg-slate-50">Semua Kategori</a>
                        <a href="/products?search=&categories%5B%5D=Sayuran+Segar"
                            class="hover:text-primary-600 block px-4 py-2 hover:bg-slate-50">Sayuran Segar</a>
                        <a href="/products?search=&categories%5B%5D=Buah-buahan"
                            class="hover:text-primary-600 block px-4 py-2 hover:bg-slate-50">Buah-buahan</a>
                        <a href="/products?search=&categories%5B%5D=Daging+dan+Unggas"
                            class="hover:text-primary-600 block px-4 py-2 hover:bg-slate-50">Daging & Unggas</a>
                    </div>
                </div>
                <a href="{{ route('about-us') }}"
                    class="px-3 py-2 font-semibold transition-colors {{ request()->is('about-us') ? 'text-primary-600' : 'text-dark hover:text-primary-600' }}">Tentang</a>
                <a href="{{ route('contact.index') }}"
                    class="px-3 py-2 font-semibold transition-colors {{ request()->is('contact') ? 'text-primary-600' : 'text-dark hover:text-primary-600' }}">Hubungi
                    Kami</a>
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('cart.index') }}"
                    class="relative px-3 py-2 text-dark font-semibold hover:text-primary-600 transition-colors items-center justify-center">
                    <i class='bx bxs-cart-alt text-2xl lg:text-[30px] text-center block'></i>
                    @if (Gloudemans\Shoppingcart\Facades\Cart::count() > 0)
                        <span
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                            {{ Gloudemans\Shoppingcart\Facades\Cart::count() }}
                        </span>
                    @endif
                </a>
                <span class="hidden lg:block h-6 w-px bg-slate-200 mx-1"></span>
                @if (Auth::check() && Auth::user()->role->value === 'supplier')
                    <a href="/supplier"
                        class="bg-primary-600 hover:bg-primary-700 rounded-lg px-5 py-2.5 font-bold text-white shadow-sm transition-colors hover:shadow-md hidden lg:block">Dashboard</a>
                @elseif (Auth::check() && Auth::user()->role->value === 'buyer')
                    <a href="{{ route('buyer.dashboard') }}"
                        class="bg-primary-600 hover:bg-primary-700 rounded-lg px-5 py-2.5 font-bold text-white shadow-sm transition-colors hover:shadow-md hidden lg:block">Dashboard</a>
                @else
                    <div class="hidden items-center space-x-2 lg:flex">
                        <a href="{{ route('auth.create', ['o' => 'login']) }}"
                            class="text-dark rounded-lg px-5 py-2.5 font-bold transition-colors hover:bg-slate-100">Masuk</a>
                        <a href="{{ route('auth.create', ['o' => 'register']) }}"
                            class="bg-primary-600 hover:bg-primary-700 rounded-lg px-5 py-2.5 font-bold text-white shadow-sm transition-colors hover:shadow-md">Daftar</a>
                    </div>
                @endif
                <div class="lg:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-dark">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div x-show="mobileMenuOpen" x-cloak class="border-t border-slate-200 bg-white lg:hidden" x-transition>
        <div class="space-y-2 px-4 py-4">
            <a href="{{ route('home') }}"
                class="block rounded-md px-4 py-2 font-semibold {{ request()->is('/') ? 'text-primary-600' : 'hover:text-primary-600 text-dark' }}">Beranda</a>
            <a href="{{ route('products.index') }}"
                class="block rounded-md px-4 py-2 font-semibold {{ request()->is('products*') ? 'text-primary-600' : 'hover:text-primary-600 text-dark' }}">Kategori</a>
            <a href="{{ route('about-us') }}"
                class=" block rounded-md px-4 py-2 font-semibold {{ request()->is('about-us') ? 'text-primary-600' : 'hover:text-primary-600 text-dark' }}">Tentang</a>
            <a href="{{ route('contact.index') }}"
                class="block rounded-md px-4 py-2 font-semibold {{ request()->is('contact') ? 'text-primary-600' : 'hover:text-primary-600 text-dark' }}">Hubungi
                Kami</a>
        </div>
        @if (Auth::check() && Auth::user()->role->value === 'supplier')
            <div class="space-y-3 border-t border-slate-200 px-4 py-4">
                <a href="/supplier"
                    class="bg-primary-600 hover:bg-primary-700 block w-full rounded-lg px-5 py-2.5 text-center font-bold text-white">Dashboard</a>
            </div>
        @elseif (Auth::check() && Auth::user()->role->value === 'buyer')
            <div class="space-y-3 border-t border-slate-200 px-4 py-4">
                <a href="{{ route('buyer.dashboard') }}"
                    class="bg-primary-600 hover:bg-primary-700 block w-full rounded-lg px-5 py-2.5 text-center font-bold text-white">Dashboard</a>
            </div>
        @else
            <div class="space-y-3 border-t border-slate-200 px-4 py-4">
                <a href="{{ route('auth.create', ['o' => 'login']) }}"
                    class="text-dark block w-full rounded-lg bg-slate-100 px-5 py-2.5 text-center font-bold hover:bg-slate-200">Masuk</a>
                <a href="{{ route('auth.create', ['o' => 'register']) }}"
                    class="bg-primary-600 hover:bg-primary-700 block w-full rounded-lg px-5 py-2.5 text-center font-bold text-white">Daftar</a>
            </div>
        @endif
    </div>
</header>
