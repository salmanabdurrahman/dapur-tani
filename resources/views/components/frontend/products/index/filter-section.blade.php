<aside
    class="fixed top-0 left-0 w-full max-w-sm h-full bg-body p-6 overflow-y-auto z-50 transform -translate-x-full transition-transform duration-300 lg:relative lg:w-1/4 lg:max-w-none lg:p-0 lg:bg-transparent lg:transform-none lg:h-auto lg:top-0 lg:left-0 lg:translate-x-0"
    :class="{ 'translate-x-0': filtersOpen }">
    <div class="lg:sticky lg:top-28 space-y-6">
        <div class="flex justify-between items-center lg:hidden">
            <h3 class="text-xl font-bold">Filter Produk</h3>
            <button @click="filtersOpen = false"><svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="bg-white p-[10px] rounded-xl shadow-sm border border-slate-200">
            <div class="relative">
                <input type="text" placeholder="Cari dalam hasil..."
                    class="w-full pl-10 pr-4 py-2 text-sm border-slate-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
            </div>
        </div>
        <div x-data="{ openCategory: true, openPrice: true, openRating: false }"
            class="bg-white rounded-xl shadow-sm border border-slate-200 divide-y divide-slate-200">
            <div class="p-5">
                <button @click="openCategory = !openCategory"
                    class="w-full flex justify-between items-center font-bold text-dark text-left">
                    <span>Kategori</span>
                    <svg :class="{ 'rotate-180': openCategory }" class="w-5 h-5 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="openCategory" class="mt-4 pt-4 border-t border-slate-200 space-y-3 text-slate-600"
                    x-transition>
                    <label class="flex items-center">
                        <input type="checkbox"
                            class="h-4 w-4 rounded border-slate-300 text-primary-600 focus:ring-primary-500 mr-3">Sayuran
                        (24)</label><label class="flex items-center">
                        <input type="checkbox"
                            class="h-4 w-4 rounded border-slate-300 text-primary-600 focus:ring-primary-500 mr-3"
                            checked>Buah-buahan (18)</label>
                </div>
            </div>
            <div class="p-5">
                <button @click="openPrice = !openPrice"
                    class="w-full flex justify-between items-center font-bold text-dark text-left">
                    <span>Rentang
                        Harga</span>
                    <svg :class="{ 'rotate-180': openPrice }" class="w-5 h-5 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="openPrice" class="mt-4 pt-4 border-t border-slate-200 space-y-3" x-transition>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-slate-500">Rp</span>
                        <input type="number" placeholder="Min"
                            class="w-full border-slate-300 rounded-md text-sm focus:ring-primary-500 focus:border-primary-500">
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-slate-500">Rp</span>
                        <input type="number" placeholder="Max"
                            class="w-full border-slate-300 rounded-md text-sm focus:ring-primary-500 focus:border-primary-500">
                    </div>
                </div>
            </div>
            <div class="p-5"><button @click="openRating = !openRating"
                    class="w-full flex justify-between items-center font-bold text-dark text-left">
                    <span>Rating</span>
                    <svg :class="{ 'rotate-180': openRating }" class="w-5 h-5 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="openRating" class="mt-4 pt-4 border-t border-slate-200 space-y-3 text-slate-600"
                    x-transition>
                    <label class="flex items-center">
                        <input type="radio" name="rating"
                            class="h-4 w-4 text-primary-600 focus:ring-primary-500 mr-3">
                        <span class="flex items-center text-amber-400">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="rating"
                            class="h-4 w-4 text-primary-600 focus:ring-primary-500 mr-3">
                        <span class="flex items-center text-amber-400">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bx-star text-slate-300'></i>
                        </span>
                    </label>
                </div>
            </div>
        </div>
        <div class="mt-8 space-y-3">
            <button
                class="w-full bg-primary-600 text-white py-3 rounded-lg font-bold hover:bg-primary-700 transition-colors shadow-sm hover:shadow-lg">Terapkan
                Filter</button>
            <button
                class="w-full bg-slate-200 text-slate-600 py-3 rounded-lg font-bold hover:bg-slate-300 transition-colors">Reset</button>
        </div>
    </div>
</aside>
