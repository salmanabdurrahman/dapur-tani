@extends('app.frontend.layouts.app')

@section('title', 'Jual Tomat Ceri Organik Dengan Kualitas Terbaik - Dapur Tani')

@section('content')
    <main class="py-12 md:py-16 my-20">
        <div class="container mx-auto px-4">
            <nav class="text-sm font-medium text-slate-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-primary-600">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('products.index') }}" class="hover:text-primary-600">Sayuran</a>
                <span class="mx-2">/</span>
                <span class="text-dark  font-semibold">Tomat Ceri Organik</span>
            </nav>
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16">
                <div x-data="{ mainImage: 'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?q=80&w=2940&auto=format&fit=crop' }">
                    <div class="mb-4">
                        <img :src="mainImage" alt="Tomat Ceri Organik"
                            class="w-full h-96 object-cover rounded-2xl shadow-lg" loading="lazy">
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        <img @click="mainImage = 'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?q=80&w=2940&auto=format&fit=crop'"
                            src="https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?q=80&w=2940&auto=format&fit=crop"
                            class="w-full h-24 object-cover rounded-xl cursor-pointer border-2 hover:border-primary-600 transition"
                            :class="{ 'border-primary-600': mainImage === 'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?q=80&w=2940&auto=format&fit=crop' }"
                            loading="lazy">
                        <img @click="mainImage = 'https://images.unsplash.com/photo-1588694853934-2453e19819c2?q=80&w=2940&auto=format&fit=crop'"
                            src="https://images.unsplash.com/photo-1588694853934-2453e19819c2?q=80&w=2940&auto=format&fit=crop"
                            class="w-full h-24 object-cover rounded-xl cursor-pointer border-2 hover:border-primary-600 transition"
                            :class="{ 'border-primary-600': mainImage === 'https://images.unsplash.com/photo-1588694853934-2453e19819c2?q=80&w=2940&auto=format&fit=crop' }"
                            loading="lazy">
                        <img @click="mainImage = 'https://images.unsplash.com/photo-1561136594-7247da04a294?q=80&w=2940&auto=format&fit=crop'"
                            src="https://images.unsplash.com/photo-1561136594-7247da04a294?q=80&w=2940&auto=format&fit=crop"
                            class="w-full h-24 object-cover rounded-xl cursor-pointer border-2 hover:border-primary-600 transition"
                            :class="{ 'border-primary-600': mainImage === 'https://images.unsplash.com/photo-1561136594-7247da04a294?q=80&w=2940&auto=format&fit=crop' }"
                            loading="lazy">
                        <img @click="mainImage = 'https://images.unsplash.com/photo-1615485925348-3c46d4a0344b?q=80&w=2940&auto=format&fit=crop'"
                            src="https://images.unsplash.com/photo-1615485925348-3c46d4a0344b?q=80&w=2940&auto=format&fit=crop"
                            class="w-full h-24 object-cover rounded-xl cursor-pointer border-2 hover:border-primary-600 transition"
                            :class="{ 'border-primary-600': mainImage === 'https://images.unsplash.com/photo-1615485925348-3c46d4a0344b?q=80&w=2940&auto=format&fit=crop' }"
                            loading="lazy">
                    </div>
                </div>
                <div>
                    <span class="bg-primary-100 text-primary-700 font-bold text-sm px-3 py-1 rounded-full">Sayuran
                        Buah</span>
                    <h1 class="text-4xl font-extrabold text-dark mt-4">Tomat Ceri Organik</h1>
                    <div class="flex items-center mt-3">
                        <span class="text-sm text-slate-500">disediakan oleh</span>
                        <a href="#" class="ml-2 text-primary-600 font-semibold hover:underline">Kebun Tani
                            Sejahtera</a>
                    </div>
                    <p class="text-lg text-slate-600 mt-6 leading-relaxed">
                        Tomat ceri berkualitas tinggi yang ditanam secara organik tanpa pestisida, menghasilkan rasa yang
                        lebih manis dan segar. Sempurna untuk salad, pasta, atau camilan sehat.
                    </p>
                    <div class="mt-8">
                        <p class="text-slate-500">Harga</p>
                        <p class="text-4xl font-extrabold text-primary-600">
                            Rp 25.000 <span class="text-xl font-semibold text-slate-500">/ kg</span>
                        </p>
                    </div>
                    <div x-data="{ quantity: 1 }" class="mt-8 flex items-center space-x-4">
                        <div class="flex items-center border-2 border-slate-200 rounded-lg">
                            <button @click="quantity = Math.max(1, quantity - 1)"
                                class="px-4 py-3 text-slate-500 hover:bg-slate-100 rounded-l-md transition">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </button>
                            <input type="text" x-model="quantity"
                                class="w-16 text-center text-lg font-bold border-none focus:ring-0">
                            <button @click="quantity++"
                                class="px-4 py-3 text-slate-500 hover:bg-slate-100 rounded-r-md transition">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                        <button
                            class="flex-1 bg-primary-600 text-white px-8 py-3.5 rounded-lg text-lg font-bold hover:bg-primary-700 transition-all duration-300 shadow-sm hover:shadow-lg">
                            Tambah ke Keranjang
                        </button>
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
                            dan tekstur yang renyah. Setiap tomat dipilih secara manual untuk menjamin hanya kualitas
                            terbaik yang sampai ke dapur Anda. Ditanam dengan metode pertanian berkelanjutan, produk ini
                            tidak hanya lezat tapi juga ramah lingkungan.</p>
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
                                    kami. Pengiriman juga selalu on-time."</p>
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
                                    rasanya juara."</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-20 lg:mt-24">
                <h2 class="text-3xl font-extrabold text-dark mb-8">Produk Lainnya dari Pemasok Ini</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                        <a href="#" class="block">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1627308595260-6fad93c2AFD6?q=80&w=2692&auto=format&fit=crop"
                                    alt="Selada"
                                    class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110"
                                    loading="lazy">
                            </div>
                            <div class="p-5">
                                <h3 class="text-lg font-bold mb-1 text-dark">Selada Romain</h3>
                                <p class="text-slate-500 text-sm mb-4">dari Kebun Tani Sejahtera</p>
                                <div class="flex justify-between items-center">
                                    <p class="text-lg font-extrabold text-primary-600">Rp12.000<span
                                            class="text-sm font-medium text-slate-500">/ikat</span></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                        <a href="#" class="block">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1597362924996-1f20a459f333?q=80&w=2940&auto=format&fit=crop"
                                    alt="Paprika"
                                    class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110"
                                    loading="lazy">
                            </div>
                            <div class="p-5">
                                <h3 class="text-lg font-bold mb-1 text-dark">Paprika Merah</h3>
                                <p class="text-slate-500 text-sm mb-4">dari Kebun Tani Sejahtera</p>
                                <div class="flex justify-between items-center">
                                    <p class="text-lg font-extrabold text-primary-600">Rp45.000<span
                                            class="text-sm font-medium text-slate-500">/kg</span></p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
