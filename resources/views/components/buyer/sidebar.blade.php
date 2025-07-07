<aside
    class="fixed lg:relative inset-y-0 left-0 bg-white shadow-lg z-50 w-64 transition-transform duration-300 transform -translate-x-full lg:translate-x-0"
    :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen && window.innerWidth < 1024 }">
    <div class="flex flex-col h-full">
        <div class="h-20 flex items-center justify-center border-b border-slate-200 flex-shrink-0">
            <a href="{{ route('buyer.dashboard') }}" class="flex items-center">
                <span class="text-2xl font-extrabold text-primary-600">Dapur Tani</span>
            </a>
        </div>
        <nav class="flex-grow p-4 space-y-2">
            <a href="{{ route('buyer.dashboard') }}"
                class="flex items-center gap-3 px-4 py-2.5 font-semibold rounded-lg {{ request()->is('buyer') ? 'bg-primary-50 text-primary-600' : 'text-slate-600 hover:bg-slate-100 hover:text-dark' }}">
                <i class='bx bxs-dashboard text-xl'></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('buyer.orders.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 font-semibold rounded-lg {{ request()->is('buyer/orders*') ? 'bg-primary-50 text-primary-600' : 'text-slate-600 hover:bg-slate-100 hover:text-dark' }}">
                <i class='bx bxs-package text-xl'></i>
                <span>Pesanan Saya</span>
            </a>
            <a href="{{ route('buyer.settings.edit') }}"
                class="flex items-center gap-3 px-4 py-2.5 font-semibold rounded-lg {{ request()->is('buyer/settings*') ? 'bg-primary-50 text-primary-600' : 'text-slate-600 hover:bg-slate-100 hover:text-dark' }}">
                <i class='bx bxs-user-circle text-xl'></i>
                <span>Pengaturan Akun</span>
            </a>
        </nav>
        <div class="p-4 border-t border-slate-200">
            <a href="#"
                class="flex items-center gap-3 px-4 py-2.5 text-slate-600 font-semibold rounded-lg hover:bg-red-50 hover:text-red-600">
                <i class='bx bx-log-out text-xl'></i>
                <span>Keluar</span>
            </a>
        </div>
    </div>
</aside>
<section x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/30 z-40 lg:hidden" x-cloak>
</section>
