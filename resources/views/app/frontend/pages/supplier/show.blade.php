@extends('app.frontend.layouts.app')

@section('title', 'Profil Pemasok: ' . ($supplier->profile->business_name ?? $supplier->name) . ' - Dapur Tani')

@section('content')
    <main class="py-20">
        <section class="bg-white pt-16 pb-12 border-b border-slate-200">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="flex-shrink-0">
                        <img src="{{ $supplier->profile->profile_photo_path ? Storage::url($supplier->profile->profile_photo_path) : 'https://i.pravatar.cc/150?u=' . $supplier->email }}"
                            alt="Logo {{ $supplier->profile->business_name ?? $supplier->name }}"
                            class="w-32 h-32 rounded-full border-4 border-white shadow-lg">
                    </div>
                    <div>
                        <h1 class="text-4xl font-extrabold text-dark tracking-tight">
                            {{ $supplier->profile->business_name ?? $supplier->name }}</h1>
                        <div class="flex items-center gap-4 mt-2 text-slate-500">
                            <div class="flex items-center gap-1">
                                <i class='bx bxs-map text-xl'></i>
                                <span>{{ $supplier->profile->city ?? 'Lokasi tidak diketahui' }},
                                    {{ $supplier->profile->province ?? '' }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <i class='bx bxs-star text-xl text-amber-400'></i>
                                <span class="font-semibold">
                                    {{ number_format(
                                        \App\Models\Review::whereIn('product_id', $supplier->products->pluck('id'))->avg('rating') ?? 0,
                                        1,
                                    ) }}
                                </span>
                                <span>({{ \App\Models\Review::whereIn('product_id', $supplier->products->pluck('id'))->count() }}
                                    ulasan)</span>
                            </div>
                        </div>
                        <p class="mt-4 text-slate-600 max-w-2xl">
                            Selamat datang di etalase resmi kami di Dapur Tani! Kami berkomitmen untuk menyediakan produk
                            segar berkualitas langsung dari kebun kami di
                            {{ $supplier->profile->city ?? 'Lokasi tidak diketahui' }}
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-extrabold text-dark mb-8">Semua Produk dari
                    {{ $supplier->profile->business_name ?? $supplier->name }}</h2>
                @if ($products->isEmpty())
                    <div class="text-center py-16 px-6 bg-white rounded-2xl shadow-sm border border-slate-200">
                        <div class="max-w-md mx-auto">
                            <i class='bx bx-store-alt text-6xl text-slate-300'></i>
                            <h3 class="mt-4 text-2xl font-bold text-dark">Belum Ada Produk</h3>
                            <p class="mt-2 text-slate-500">Pemasok ini belum menambahkan produk apa pun ke etalase mereka.
                            </p>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                        @foreach ($products as $product)
                            @php
                                $discountedPrice = $product->getDiscountedPrice();
                            @endphp

                            <div
                                class="bg-white rounded-xl shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1.5">
                                <a href="{{ route('products.show', $product) }}" class="block">
                                    <div class="relative">
                                        <img src="{{ Storage::url($product->main_image_path) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110">
                                        <div
                                            class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-dark">
                                            {{ $product->category->name }}</div>
                                    </div>
                                    <div class="p-5 flex flex-col">
                                        <h3 class="text-lg font-bold text-dark mb-1 truncate">{{ $product->name }}</h3>
                                        <div class="flex-grow"></div>
                                        <div class="flex justify-between items-center pt-2 mt-2 border-t border-slate-100">
                                            @if ($discountedPrice && $discountedPrice < $product->price)
                                                <div>
                                                    <p class="text-sm font-semibold text-red-500 line-through">
                                                        Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                                    <p class="text-lg font-extrabold text-primary-600">
                                                        Rp{{ number_format($discountedPrice, 0, ',', '.') }}
                                                        <span
                                                            class="text-sm font-medium text-slate-500">/{{ $product->unit }}</span>
                                                    </p>
                                                </div>
                                            @else
                                                <p class="text-lg font-extrabold text-primary-600">
                                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                                    <span
                                                        class="text-sm font-medium text-slate-500">/{{ $product->unit }}</span>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <nav class="mt-12 flex justify-center">
                        {{ $products->links() }}
                    </nav>
                @endif
            </div>
        </section>
    </main>
@endsection
