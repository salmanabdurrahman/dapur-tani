@extends('app.frontend.layouts.app')

@section('title', 'Jual Tomat Ceri Organik Dengan Kualitas Terbaik - Dapur Tani')

@section('content')
    <main class="py-12 md:py-16 my-20">
        <section class="container mx-auto px-4 relative py-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-dark tracking-tight mb-10">Detail Tomat Ceri Organik</h1>
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16">
                <div x-data="{ mainImage: 'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?q=80&w=1200' }">
                    <div class="mb-4 bg-white p-4 rounded-2xl shadow-lg border border-slate-200">
                        <img :src="mainImage" alt="Tomat Ceri Organik" class="w-full h-96 object-cover rounded-xl"
                            loading="lazy">
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        <div @click="mainImage = 'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?q=80&w=600'"
                            class="rounded-xl cursor-pointer ring-2 ring-transparent hover:ring-primary-600 transition-all"
                            :class="{ '!ring-primary-600': mainImage === 'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?q=80&w=600' }">
                            <img src="https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?q=80&w=300"
                                class="w-full h-24 object-cover rounded-lg" loading="lazy">
                        </div>
                        <div @click="mainImage = 'https://images.unsplash.com/photo-1588694853934-2453e19819c2?q=80&w=600'"
                            class="rounded-xl cursor-pointer ring-2 ring-transparent hover:ring-primary-600 transition-all"
                            :class="{ '!ring-primary-600': mainImage === 'https://images.unsplash.com/photo-1588694853934-2453e19819c2?q=80&w=600' }">
                            <img src="https://images.unsplash.com/photo-1588694853934-2453e19819c2?q=80&w=300"
                                class="w-full h-24 object-cover rounded-lg" loading="lazy">
                        </div>
                        <div @click="mainImage = 'https://images.unsplash.com/photo-1561136594-7247da04a294?q=80&w=600'"
                            class="rounded-xl cursor-pointer ring-2 ring-transparent hover:ring-primary-600 transition-all"
                            :class="{ '!ring-primary-600': mainImage === 'https://images.unsplash.com/photo-1561136594-7247da04a294?q=80&w=600' }">
                            <img src="https://images.unsplash.com/photo-1561136594-7247da04a294?q=80&w=300"
                                class="w-full h-24 object-cover rounded-lg" loading="lazy">
                        </div>
                        <div @click="mainImage = 'https://images.unsplash.com/photo-1615485925348-3c46d4a0344b?q=80&w=600'"
                            class="rounded-xl cursor-pointer ring-2 ring-transparent hover:ring-primary-600 transition-all"
                            :class="{ '!ring-primary-600': mainImage === 'https://images.unsplash.com/photo-1615485925348-3c46d4a0344b?q=80&w=600' }">
                            <img src="https://images.unsplash.com/photo-1615485925348-3c46d4a0344b?q=80&w=300"
                                class="w-full h-24 object-cover rounded-lg" loading="lazy">
                        </div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="bg-primary-100 text-primary-700 font-bold text-sm px-3 py-1 rounded-full">Sayuran
                                Buah</span>
                            <h1 class="text-4xl font-extrabold text-dark mt-4">Tomat Ceri Organik</h1>
                        </div>
                        <div class="bg-primary-500 text-white text-sm font-bold px-3 py-1 rounded-full">TERSEDIA</div>
                    </div>
                    <div class="mt-8 pt-6 border-t border-slate-200">
                        <p class="text-slate-500">Harga</p>
                        <p class="text-4xl font-extrabold text-primary-600">
                            Rp 25.000 <span class="text-xl font-semibold text-slate-500">/ kg</span>
                        </p>
                        <p class="text-sm text-slate-500 mt-1">Minimum pemesanan: 1 kg</p>
                    </div>
                    <div x-data="{ quantity: 1 }" class="mt-8 space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="font-bold text-dark">Jumlah</label>
                            <div class="flex items-center border-2 border-slate-200 rounded-lg">
                                <button @click="quantity = Math.max(1, quantity - 1)"
                                    class="px-4 py-2.5 text-slate-500 hover:bg-slate-100 rounded-l-md transition"><svg
                                        class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 12H4" />
                                    </svg></button>
                                <input type="text" x-model="quantity"
                                    class="w-16 text-center text-lg font-bold border-none focus:ring-0 focus:outline-none"
                                    readonly>
                                <button @click="quantity++"
                                    class="px-4 py-2.5 text-slate-500 hover:bg-slate-100 rounded-r-md transition"><svg
                                        class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg></button>
                            </div>
                        </div>
                        <button
                            class="w-full flex items-center justify-center gap-3 bg-primary-600 text-white px-8 py-4 rounded-xl text-lg font-bold hover:bg-primary-700 transition-all duration-300 shadow-lg hover:shadow-primary-300 transform hover:-translate-y-0.5">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c.51 0 .962-.343 1.087-.835l1.823-6.841a.75.75 0 0 0-.543-.922l-13.5-3A.75.75 0 0 0 4.5 5.69l.522 1.942a.75.75 0 0 0 .674.528a.75.75 0 0 0 .674-.528L6.61 5.244a.75.75 0 0 1 .543-.922l13.5-3a.75.75 0 0 1 .922.543l-1.823 6.841a1.125 1.125 0 0 1-1.087.835H7.5Z" />
                            </svg>
                            <span>Tambah ke Keranjang</span>
                        </button>
                    </div>
                    <div class="mt-8 pt-6 border-t border-slate-200">
                        <p class="font-bold text-dark mb-3">Informasi Pemasok</p>
                        <div class="flex items-center">
                            <img src="https://i.pravatar.cc/60?u=kebutani" alt="Logo Pemasok"
                                class="w-14 h-14 rounded-full border-2 border-white shadow-md" loading="lazy">
                            <div class="ml-4">
                                <a href="#" class="font-bold text-dark hover:text-primary-600 transition-colors">Kebun
                                    Tani Sejahtera</a>
                                <div class="flex items-center text-sm text-slate-500 mt-1">
                                    <svg class="w-4 h-4 text-amber-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    4.9 (230 Ulasan)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div x-data="{ activeTab: 'deskripsi' }" class="mt-20 lg:mt-24">
                <div class="border-b border-slate-200 mb-8">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button @click="activeTab = 'deskripsi'"
                            :class="{ 'border-primary-600 text-primary-600': activeTab === 'deskripsi', 'border-transparent text-slate-500 hover:text-dark hover:border-slate-300': activeTab !== 'deskripsi' }"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-lg transition-colors">Deskripsi</button>
                        <button @click="activeTab = 'spesifikasi'"
                            :class="{ 'border-primary-600 text-primary-600': activeTab === 'spesifikasi', 'border-transparent text-slate-500 hover:text-dark hover:border-slate-300': activeTab !== 'spesifikasi' }"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-lg transition-colors">Spesifikasi</button>
                        <button @click="activeTab = 'ulasan'"
                            :class="{ 'border-primary-600 text-primary-600': activeTab === 'ulasan', 'border-transparent text-slate-500 hover:text-dark hover:border-slate-300': activeTab !== 'ulasan' }"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-lg transition-colors">Ulasan
                            (12)</button>
                    </nav>
                </div>
                <div class="prose max-w-none prose-slate">
                    <div x-show="activeTab === 'deskripsi'" x-transition>
                        <h3>Kualitas Terbaik dari Alam</h3>
                        <p>Tomat ceri organik kami dipanen pada tingkat kematangan puncak untuk memastikan rasa manis alami
                            dan
                            tekstur yang renyah. Setiap tomat dipilih secara manual untuk menjamin hanya kualitas terbaik
                            yang
                            sampai ke dapur Anda. Ditanam dengan metode pertanian berkelanjutan, produk ini tidak hanya
                            lezat tapi
                            juga ramah lingkungan.</p>
                        <ul>
                            <li>Rasa manis alami dengan sedikit sentuhan asam yang menyegarkan.</li>
                            <li>Tekstur padat dan juicy, ideal untuk berbagai masakan.</li>
                            <li>Bebas dari pestisida dan bahan kimia berbahaya.</li>
                        </ul>
                    </div>
                    <div x-show="activeTab === 'spesifikasi'" x-transition>
                        <h3>Detail Produk</h3>
                        <dl class="grid grid-cols-2 gap-x-8 gap-y-4">
                            <div>
                                <dt class="font-bold text-dark">Asal</dt>
                                <dd>Lereng Gunung Merapi, Yogyakarta</dd>
                            </div>
                            <div>
                                <dt class="font-bold text-dark">Sertifikasi</dt>
                                <dd>Organik Indonesia</dd>
                            </div>
                            <div>
                                <dt class="font-bold text-dark">Grade</dt>
                                <dd>Grade A Super</dd>
                            </div>
                            <div>
                                <dt class="font-bold text-dark">Minimum Order</dt>
                                <dd>1 kg</dd>
                            </div>
                        </dl>
                    </div>
                    <div x-show="activeTab === 'ulasan'" x-transition>
                        <h3>Ulasan dari Pelanggan</h3>
                        <div class="space-y-6">
                            <div class="border-b border-slate-200 pb-6">
                                <div class="flex items-center mb-2">
                                    <img src="https://i.pravatar.cc/40?u=1" class="w-10 h-10 rounded-full mr-3"
                                        loading="lazy">
                                    <div>
                                        <p class="font-bold text-dark">Chef Budi - Hotel Bintang Lima</p>
                                        <p class="text-sm text-slate-500 flex items-center">★★★★★</p>
                                    </div>
                                </div>
                                <p>"Tomatnya benar-benar segar! Manis dan cocok sekali untuk saus pasta andalan restoran
                                    kami.
                                    Pengiriman juga selalu on-time."</p>
                            </div>
                            <div class="border-b border-slate-200 pb-6">
                                <div class="flex items-center mb-2">
                                    <img src="https://i.pravatar.cc/40?u=4" class="w-10 h-10 rounded-full mr-3"
                                        loading="lazy">
                                    <div>
                                        <p class="font-bold text-dark">Rina - Dapur Sehat Cafe</p>
                                        <p class="text-sm text-slate-500 flex items-center">★★★★★</p>
                                    </div>
                                </div>
                                <p>"Pelanggan kami suka sekali dengan salad yang menggunakan tomat ini. Warnanya cerah dan
                                    rasanya
                                    juara."</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-20 lg:mt-24">
                <h2 class="text-3xl font-extrabold text-dark mb-8">Anda Mungkin Juga Suka</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1.5">
                        <a href="#" class="block">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1627308595260-6fad93c2AFD6?q=80&w=600"
                                    alt="Selada"
                                    class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110"
                                    loading="lazy">
                                <div
                                    class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-dark">
                                    Sayuran Daun</div>
                            </div>
                            <div class="p-5 flex flex-col">
                                <h3 class="text-lg font-bold text-dark mb-1 truncate">Selada Romain Hidroponik</h3>
                                <p class="text-slate-500 text-sm mb-4 truncate flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-primary-600" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>Kebun Tani Sejahtera
                                </p>
                                <div class="flex justify-between items-center pt-2 mt-auto border-t border-slate-100">
                                    <p class="text-lg font-extrabold text-primary-600">Rp12.000
                                        <span class="text-sm font-medium text-slate-500">/ikat</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
