@extends('app.frontend.layouts.app')

@section('title', "Jual $product->name Dengan Kualitas Terbaik - Dapur Tani")

@section('content')
    <main class="py-12 md:py-20 my-20" x-data="{ subscribeModalOpen: false }">
        <section class="container mx-auto px-4 relative">
            <h1 class="text-4xl md:text-5xl font-extrabold text-dark tracking-tight mb-10">Detail {{ $product->name }}</h1>
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16">
                <div x-data="{ mainImage: '{{ $product->main_image_path ? Storage::url($product->main_image_path) : 'https://via.placeholder.com/600x400?text=No+Image' }}' }">
                    <div class="mb-4 bg-white p-4 rounded-2xl shadow-lg border border-slate-200">
                        <img :src="mainImage" alt="{{ $product->name }}"
                            class="w-full h-96 object-fit-contain rounded-xl @if ($product->stock_quantity <= 0) grayscale-[50%] opacity-50 @endif"
                            loading="lazy">
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        @php
                            $gallery = [];

                            if ($product->main_image_path) {
                                $gallery[] = Storage::url($product->main_image_path);
                            }

                            if (!empty($product->images)) {
                                foreach ($product->images as $img) {
                                    $gallery[] = Storage::url($img);
                                }
                            }

                            if (empty($gallery)) {
                                $gallery[] = 'https://via.placeholder.com/600x400?text=No+Image';
                            }
                        @endphp

                        @foreach ($gallery as $img)
                            <div @click="mainImage = '{{ $img }}'"
                                class="rounded-xl cursor-pointer ring-2 ring-transparent hover:ring-primary-600 transition-all"
                                :class="{ '!ring-primary-600': mainImage === '{{ $img }}' }">
                                <img src="{{ $img }}"
                                    class="w-full h-24 object-cover rounded-lg @if ($product->stock_quantity <= 0) grayscale-[50%] opacity-50 @endif"
                                    loading="lazy">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <span
                                class="bg-primary-100 text-primary-700 font-bold text-sm px-3 py-1 rounded-full">{{ $product->category->name }}</span>
                            <h1 class="text-4xl font-extrabold text-dark mt-4">{{ $product->name }}</h1>
                        </div>
                        @if ($product->stock_quantity > 0)
                            <div class="bg-primary-500 text-white text-sm font-bold px-3 py-1 rounded-full">TERSEDIA</div>
                        @else
                            <div class="bg-red-500 text-white text-sm font-bold px-3 py-1 rounded-full">HABIS</div>
                        @endif
                    </div>
                    <div class="mt-4 flex items-center gap-2">
                        <span class="font-semibold text-dark">Stok:</span>
                        <span class="text-slate-700">{{ $product->stock_quantity }} {{ $product->unit }}</span>
                    </div>
                    <div class="mt-8 pt-6 border-t border-slate-200">
                        @php
                            $promotion = $product->getActivePromotion();
                            $discountedPrice = $product->getDiscountedPrice();
                        @endphp

                        <p class="text-slate-500">Harga</p>
                        @if ($promotion)
                            <div
                                class="bg-red-100 text-red-600 text-sm font-bold px-3 py-1 mt-1 rounded-md items-center gap-1 inline-flex">
                                <i class='bx bxs-discount'></i>
                                <span>
                                    @if ($promotion->type === 'percentage')
                                        DISKON {{ $promotion->value }}%
                                    @else
                                        POTONGAN HARGA
                                    @endif
                                </span>
                            </div>
                        @endif
                        @if ($discountedPrice && $discountedPrice < $product->price)
                            <div class="mt-2">
                                <p class="text-xl font-semibold text-slate-400 line-through">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                <p class="text-4xl font-extrabold text-primary-600">
                                    Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                                    <span class="text-xl font-semibold text-slate-500">/ {{ $product->unit }}</span>
                                </p>
                            </div>
                        @else
                            <p class="text-4xl font-extrabold text-primary-600 mt-2">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                <span class="text-xl font-semibold text-slate-500">/ {{ $product->unit }}</span>
                            </p>
                        @endif
                        <p class="text-sm text-slate-500 mt-1">Minimum pemesanan: 1 {{ $product->unit }}</p>
                    </div>
                    <form method="POST" action="{{ route('cart.store') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div x-data="{ quantity: 1 }" class="mt-8 space-y-4">
                            <div class="flex items-center justify-between">
                                <label class="font-bold text-dark">Jumlah</label>
                                <div class="flex items-center border-2 border-slate-200 rounded-lg">
                                    <button type="button"
                                        @click="{{ $product->stock_quantity > 0 ? 'quantity = Math.max(1, quantity - 1)' : '' }}"
                                        class="px-4 py-2.5 text-slate-500 hover:bg-slate-100 rounded-l-md transition">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 12H4" />
                                        </svg>
                                    </button>
                                    <input type="text" name="quantity" x-model="quantity" :value="1"
                                        class="w-16 text-center text-lg font-bold border-none focus:ring-0 focus:outline-none"
                                        readonly required>
                                    <button type="button" @click="{{ $product->stock_quantity > 0 ? 'quantity++' : '' }}"
                                        class="px-4 py-2.5 text-slate-500 hover:bg-slate-100 rounded-r-md transition">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-3 bg-primary-600 text-white px-8 py-4 rounded-xl text-lg font-bold hover:bg-primary-700 transition-all duration-300 shadow-lg hover:shadow-primary-300 transform hover:-translate-y-0.5 @if ($product->stock_quantity <= 0) opacity-50 cursor-not-allowed @else hover:opacity-90 @endif"
                                @if ($product->stock_quantity <= 0) disabled @endif>
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c.51 0 .962-.343 1.087-.835l1.823-6.841a.75.75 0 0 0-.543-.922l-13.5-3A.75.75 0 0 0 4.5 5.69l.522 1.942a.75.75 0 0 0 .674.528a.75.75 0 0 0 .674-.528L6.61 5.244a.75.75 0 0 1 .543-.922l13.5-3a.75.75 0 0 1 .922.543l-1.823 6.841a1.125 1.125 0 0 1-1.087.835H7.5Z" />
                                </svg>
                                <span>Tambah ke Keranjang</span>
                            </button>
                            <button @click="subscribeModalOpen = true" type="button"
                                class="mt-4 w-full flex items-center justify-center gap-3 border-2 border-primary-600 text-primary-600 px-8 py-3.5 rounded-xl text-lg font-bold hover:bg-primary-50 transition-all">
                                <i class='bx bx-calendar-event text-xl'></i>
                                <span>Jadikan Pesanan Rutin</span>
                            </button>
                        </div>
                    </form>
                    <div class="mt-8 pt-6 border-t border-slate-200">
                        <p class="font-bold text-dark mb-3">Informasi Pemasok</p>
                        <div class="flex items-center">
                            <img src="{{ $product->supplier->profile->profile_photo_path ? Storage::url($product->supplier->profile->profile_photo_path) : 'https://i.pravatar.cc/60?u=' . urlencode($product->supplier->name) }}"
                                alt="Logo Pemasok" class="w-14 h-14 rounded-full border-2 border-white shadow-md"
                                loading="lazy">
                            <div class="ml-4">
                                <a href="#"
                                    class="font-bold text-dark hover:text-primary-600 transition-colors">{{ $product->supplier->profile->business_name ?? $product->supplier->name }}</a>
                                <div class="flex items-center text-sm text-slate-500 mt-1">
                                    <svg class="w-4 h-4 text-amber-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    {{ number_format($product->reviews->avg('rating'), 1) }}
                                    ({{ count($product->reviews) }}
                                    Ulasan)
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
                            ({{ count($product->reviews) }})</button>
                    </nav>
                </div>
                <div class="prose max-w-none prose-slate">
                    <div x-show="activeTab === 'deskripsi'" x-transition>
                        <h3 class="text-lg font-semibold mb-3">Deskripsi Produk</h3>
                        <article
                            class="prose max-w-none prose-slate prose-pre:bg-slate-900 prose-pre:text-white prose-pre:rounded-lg prose-pre:p-4 prose-code:bg-slate-100 prose-code:rounded prose-code:px-1 prose-code:py-0.5 prose-img:rounded-lg prose-blockquote:border-primary-600 prose-blockquote:pl-4 prose-blockquote:italic">
                            {!! \Illuminate\Support\Str::markdown($product->description ?? 'Belum ada deskripsi untuk produk ini.') !!}
                        </article>
                    </div>
                    <div x-show="activeTab === 'spesifikasi'" x-transition>
                        <h3 class="text-lg font-semibold mb-3">Detail Produk</h3>
                        <dl class="grid grid-cols-2 gap-x-8 gap-y-4">
                            <div>
                                <dt class="font-bold text-dark">Asal</dt>
                                <dd>{{ $product->supplier->profile->address ?? 'Tidak Diketahui' }}</dd>
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
                                <dd>1 {{ $product->unit ?? 'kg' }}</dd>
                            </div>
                        </dl>
                    </div>
                    <div x-show="activeTab === 'ulasan'" x-transition>
                        <h3 class="text-lg font-semibold mb-3">Ulasan dari Pelanggan</h3>
                        <div class="space-y-6">
                            @forelse ($product->reviews as $review)
                                <div class="border-b border-slate-200 pb-6">
                                    <div class="flex items-center mb-2">
                                        <img src="{{ $review->user->profile->profile_photo_path ? Storage::url($review->user->profile->profile_photo_path) : 'https://i.pravatar.cc/60?u=' . urlencode($review->user->name) }}"
                                            class="w-10 h-10 rounded-full mr-3" loading="lazy">
                                        <div>
                                            <p class="font-bold text-dark">
                                                {{ $review->user->profile->business_name ?? $review->user->name }}
                                            </p>
                                            <p class="text-sm text-slate-500 flex items-center">
                                                {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                                            </p>
                                        </div>
                                    </div>
                                    <p>"{{ $review->comment }}"</p>
                                </div>
                            @empty
                                <p>Belum ada ulasan untuk produk ini.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-20 lg:mt-24">
                <h2 class="text-3xl font-extrabold text-dark mb-8">Anda Mungkin Juga Suka</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($randomProducts as $product)
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1.5">
                            <a href="{{ route('products.show', $product) }}" class="block">
                                <div class="relative">
                                    <img src="{{ Storage::url($product->main_image_path) }}" alt="{{ $product->name }}"
                                        class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110"
                                        loading="lazy">
                                </div>
                                <div class="p-5 flex flex-col">
                                    <h3 class="text-lg font-bold text-dark mb-1 truncate">{{ $product->name }}</h3>
                                    <p class="text-slate-500 text-sm mb-4 truncate flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-primary-600" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>{{ $product->supplier->profile->business_name ?? $product->supplier->name }}
                                    </p>
                                    <div class="flex justify-between items-center pt-2 mt-auto border-t border-slate-100">
                                        <p class="text-lg font-extrabold text-primary-600">
                                            Rp{{ number_format($product->price, 0, ',', '.') }}
                                            <span class="text-sm font-medium text-slate-500">/{{ $product->unit }}</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        {{-- Modal for product subscription --}}
        <div x-show="subscribeModalOpen" x-cloak
            class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4" x-transition.opacity>
            <div @click.away="subscribeModalOpen = false"
                class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-8 transform transition-all"
                x-show="subscribeModalOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <h2 class="text-2xl font-bold text-dark mb-4">Atur Langganan untuk {{ $product->name }}</h2>
                <form action="{{ route('buyer.recurring-orders.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="space-y-4">
                        <div>
                            <label for="sub-quantity" class="font-semibold text-dark">Kuantitas per Pengiriman</label>
                            <input type="number" id="sub-quantity" name="quantity" value="1" min="1"
                                class="mt-2 w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                        </div>
                        <div>
                            <label for="sub-frequency" class="font-semibold text-dark">Frekuensi</label>
                            <select id="sub-frequency" name="frequency"
                                class="mt-2 w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                                <option value="weekly">Setiap Minggu</option>
                            </select>
                        </div>
                        <div>
                            <label for="sub-day" class="font-semibold text-dark">Hari Pengiriman</label>
                            <select id="sub-day" name="day_of_week"
                                class="mt-2 w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                                <option value="monday">Senin</option>
                                <option value="tuesday">Selasa</option>
                                <option value="wednesday">Rabu</option>
                                <option value="thursday">Kamis</option>
                                <option value="friday">Jumat</option>
                                <option value="saturday">Sabtu</option>
                                <option value="sunday">Minggu</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-slate-200">
                        <button type="button" @click="subscribeModalOpen = false"
                            class="bg-slate-100 text-dark font-bold px-6 py-2.5 rounded-lg hover:bg-slate-200">Batal</button>
                        <button type="submit"
                            class="bg-primary-600 text-white font-bold px-6 py-2.5 rounded-lg hover:bg-primary-700">Simpan
                            Langganan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
