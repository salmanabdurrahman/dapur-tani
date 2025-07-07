@extends('app.frontend.layouts.app')

@section('title', 'Jelajahi Produk Segar & Bahan Baku - Dapur Tani')

@section('content')
    <main class="py-12 md:py-16 my-20">
        <section class="container mx-auto px-4 relative py-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-dark tracking-tight mb-10">Jelajahi Semua Produk</h1>
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-8 lg:items-start" x-data="{ filtersOpen: false }">
                <div x-show="filtersOpen" x-cloak x-transition:enter="transition-opacity ease-linear duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/40 z-40 lg:hidden"
                    @click="filtersOpen = false"></div>
                <aside
                    class="fixed top-0 left-0 w-full max-w-sm h-full bg-body p-6 overflow-y-auto z-50 transform -translate-x-full transition-transform duration-300 lg:relative lg:w-1/4 lg:max-w-none lg:p-0 lg:bg-transparent lg:transform-none lg:h-auto lg:top-0 lg:left-0 lg:translate-x-0"
                    :class="{ 'translate-x-0': filtersOpen }">
                    <div class="lg:sticky lg:top-28 space-y-6">
                        <div class="flex justify-between items-center lg:hidden">
                            <h3 class="text-xl font-bold">Filter Produk</h3>
                            <button @click="filtersOpen = false"><svg class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="bg-white p-[10px] rounded-xl shadow-sm border border-slate-200">
                            <div class="relative">
                                <input type="text" placeholder="Cari dalam hasil..."
                                    class="w-full pl-10 pr-4 py-2 text-sm border-slate-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
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
                                    <svg :class="{ 'rotate-180': openCategory }" class="w-5 h-5 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div x-show="openCategory"
                                    class="mt-4 pt-4 border-t border-slate-200 space-y-3 text-slate-600" x-transition>
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
                                    <svg :class="{ 'rotate-180': openPrice }" class="w-5 h-5 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div x-show="openPrice" class="mt-4 pt-4 border-t border-slate-200 space-y-3" x-transition>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm text-slate-500">Rp</span>
                                        <input type="number" placeholder="Min"
                                            class="w-full border-slate-300 rounded-md text-sm focus:ring-primary-500 focus:border-primary-500 focus:outline-none">
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm text-slate-500">Rp</span>
                                        <input type="number" placeholder="Max"
                                            class="w-full border-slate-300 rounded-md text-sm focus:ring-primary-500 focus:border-primary-500 focus:outline-none">
                                    </div>
                                </div>
                            </div>
                            <div class="p-5"><button @click="openRating = !openRating"
                                    class="w-full flex justify-between items-center font-bold text-dark text-left">
                                    <span>Rating</span>
                                    <svg :class="{ 'rotate-180': openRating }" class="w-5 h-5 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div x-show="openRating"
                                    class="mt-4 pt-4 border-t border-slate-200 space-y-3 text-slate-600" x-transition>
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
                <div class="lg:w-3/4">
                    <div
                        class="flex flex-col md:flex-row justify-between md:items-center mb-6 bg-white p-4 rounded-xl shadow-sm border border-slate-200">
                        <p class="text-slate-600 font-medium mb-4 md:mb-0">Menampilkan 1-9 dari 84 produk</p>
                        <div class="flex items-center gap-2">
                            <button @click="filtersOpen = true"
                                class="lg:hidden flex-1 flex items-center justify-center space-x-2 bg-slate-100 px-4 py-2.5 rounded-lg font-semibold"><svg
                                    class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.572a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                                </svg><span>Filter</span>
                            </button>
                            <select id="sort"
                                class="flex-1 rounded-lg border-slate-300 font-semibold focus:ring-primary-500 focus:border-primary-500 focus:outline-none">
                                <option hidden>Urutkan:</option>
                                <option>Terbaru</option>
                                <option>Harga Terendah</option>
                                <option>Harga Tertinggi</option>
                                <option>Terlama</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1.5">
                            <a href="/produk-detail" class="block">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?q=80&w=600"
                                        alt="Tomat"
                                        class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110"
                                        loading="lazy">
                                    <div
                                        class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-dark">
                                        Sayuran Buah</div>
                                </div>
                                <div class="p-5 flex flex-col">
                                    <h3 class="text-lg font-bold text-dark mb-1 truncate">Tomat Ceri Organik</h3>
                                    <p class="text-slate-500 text-sm mb-4 truncate flex items-center"><svg
                                            class="w-4 h-4 mr-1 text-primary-600" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>Kebun Tani Sejahtera</p>
                                    <div class="flex justify-between items-center pt-2 mt-auto border-t border-slate-100">
                                        <p class="text-lg font-extrabold text-primary-600">Rp25.000<span
                                                class="text-sm font-medium text-slate-500">/kg</span></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1.5">
                            <a href="/produk-detail" class="block">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1563636423928-a3b234344314?q=80&w=600"
                                        alt="Wortel"
                                        class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110"
                                        loading="lazy">
                                    <div
                                        class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-dark">
                                        Sayuran Umbi</div>
                                </div>
                                <div class="p-5 flex flex-col">
                                    <h3 class="text-lg font-bold text-dark mb-1 truncate">Wortel Berastagi</h3>
                                    <p class="text-slate-500 text-sm mb-4 truncate flex items-center"><svg
                                            class="w-4 h-4 mr-1 text-primary-600" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>Tani Makmur</p>
                                    <div class="flex justify-between items-center pt-2 mt-auto border-t border-slate-100">
                                        <p class="text-lg font-extrabold text-primary-600">Rp15.000<span
                                                class="text-sm font-medium text-slate-500">/kg</span></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1.5">
                            <a href="/produk-detail" class="block">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1587351177733-a037418a3e42?q=80&w=600"
                                        alt="Brokoli"
                                        class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110"
                                        loading="lazy">
                                    <div
                                        class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-dark">
                                        Sayuran Bunga</div>
                                </div>
                                <div class="p-5 flex flex-col">
                                    <h3 class="text-lg font-bold text-dark mb-1 truncate">Brokoli Hidroponik</h3>
                                    <p class="text-slate-500 text-sm mb-4 truncate flex items-center"><svg
                                            class="w-4 h-4 mr-1 text-primary-600" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>Green Farmhouse</p>
                                    <div class="flex justify-between items-center pt-2 mt-auto border-t border-slate-100">
                                        <p class="text-lg font-extrabold text-primary-600">Rp18.000<span
                                                class="text-sm font-medium text-slate-500">/kg</span></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1.5">
                            <a href="/produk-detail" class="block">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1628109635955-396a8a18357f?q=80&w=600"
                                        alt="Bawang"
                                        class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110"
                                        loading="lazy">
                                    <div
                                        class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-dark">
                                        Bumbu Dapur</div>
                                </div>
                                <div class="p-5 flex flex-col">
                                    <h3 class="text-lg font-bold text-dark mb-1 truncate">Bawang Merah Brebes</h3>
                                    <p class="text-slate-500 text-sm mb-4 truncate flex items-center"><svg
                                            class="w-4 h-4 mr-1 text-primary-600" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>Tani Jaya</p>
                                    <div class="flex justify-between items-center pt-2 mt-auto border-t border-slate-100">
                                        <p class="text-lg font-extrabold text-primary-600">Rp38.000<span
                                                class="text-sm font-medium text-slate-500">/kg</span></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1.5">
                            <a href="/produk-detail" class="block">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1523049673857-eb18f1d7b578?q=80&w=600"
                                        alt="Alpukat"
                                        class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110"
                                        loading="lazy">
                                    <div
                                        class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-dark">
                                        Buah</div>
                                </div>
                                <div class="p-5 flex flex-col">
                                    <h3 class="text-lg font-bold text-dark mb-1 truncate">Alpukat Mentega Jumbo</h3>
                                    <p class="text-slate-500 text-sm mb-4 truncate flex items-center"><svg
                                            class="w-4 h-4 mr-1 text-primary-600" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>Mutiara Farm</p>
                                    <div class="flex justify-between items-center pt-2 mt-auto border-t border-slate-100">
                                        <p class="text-lg font-extrabold text-primary-600">Rp35.000<span
                                                class="text-sm font-medium text-slate-500">/kg</span></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1.5">
                            <a href="/produk-detail" class="block">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1601253467812-32520763a436?q=80&w=600"
                                        alt="Daging"
                                        class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110"
                                        loading="lazy">
                                    <div
                                        class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-dark">
                                        Daging Segar</div>
                                </div>
                                <div class="p-5 flex flex-col">
                                    <h3 class="text-lg font-bold text-dark mb-1 truncate">Daging Sapi Has Dalam</h3>
                                    <p class="text-slate-500 text-sm mb-4 truncate flex items-center"><svg
                                            class="w-4 h-4 mr-1 text-primary-600" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>Peternakan Sentosa</p>
                                    <div class="flex justify-between items-center pt-2 mt-auto border-t border-slate-100">
                                        <p class="text-lg font-extrabold text-primary-600">Rp150.000<span
                                                class="text-sm font-medium text-slate-500">/kg</span></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <nav class="mt-12 flex justify-center">
                        <ul class="flex items-center -space-x-px h-10 text-base">
                            <li><a href="#"
                                    class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-slate-500 bg-white border border-slate-300 rounded-s-lg hover:bg-slate-100 hover:text-dark">Sebelumnya</a>
                            </li>
                            <li><a href="#" aria-current="page"
                                    class="z-10 flex items-center justify-center px-4 h-10 font-bold leading-tight text-white bg-primary-600 border border-primary-600 hover:bg-primary-700">1</a>
                            </li>
                            <li><a href="#"
                                    class="flex items-center justify-center px-4 h-10 text-slate-500 bg-white border border-slate-300 hover:bg-slate-100 hover:text-dark">2</a>
                            </li>
                            <li><a href="#"
                                    class="flex items-center justify-center px-4 h-10 text-slate-500 bg-white border border-slate-300 hover:bg-slate-100 hover:text-dark">3</a>
                            </li>
                            <li><a href="#"
                                    class="flex items-center justify-center px-4 h-10 leading-tight text-slate-500 bg-white border border-slate-300 rounded-e-lg hover:bg-slate-100 hover:text-dark">Berikutnya</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
    </main>
@endsection
