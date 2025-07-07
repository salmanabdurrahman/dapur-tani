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
    <x-frontend.auth.buyer.login-form />
    <x-frontend.auth.buyer.register-form />
    <x-frontend.auth.buyer.alternative-login />
    <div class="mt-8 text-center">
        <p class="text-sm">
            Anda seorang Pemasok?
            <a href="#" class="font-bold text-primary-600 hover:underline">Masuk atau Daftar di sini</a>
        </p>
    </div>
</div>
