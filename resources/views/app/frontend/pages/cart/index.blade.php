@extends('app.frontend.layouts.app')

@section('title', 'Keranjang Belanja Anda - Dapur Tani')

@section('content')
    <main class="py-12 md:py-16 my-20">
        <section class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-extrabold text-dark tracking-tight mb-10">Keranjang Belanja Anda</h1>
            @if (Gloudemans\Shoppingcart\Facades\Cart::count() > 0)
                <div class="grid lg:grid-cols-12 gap-8 items-start">
                    <div class="lg:col-span-8">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                            <div class="space-y-6 divide-y divide-slate-100">
                                @foreach ($cartItems as $item)
                                    <div class="flex items-center gap-4 pt-6 first:pt-0" x-data="{ quantity: {{ $item->qty }} }">
                                        <img src="{{ Storage::url($item->options->image) }}" alt="{{ $item->name }}"
                                            class="w-28 h-28 object-cover rounded-lg flex-shrink-0" loading="lazy">
                                        <div class="flex-grow">
                                            <p class="font-bold text-dark text-lg">{{ $item->name }}</p>
                                            <p class="text-sm text-slate-500 mt-1">Rp
                                                {{ number_format($item->price, 0, ',', '.') }} / {{ $item->options->unit }}
                                            </p>
                                            <div class="flex items-center gap-2 mt-4">
                                                <div class="flex items-center border-2 border-slate-200 rounded-lg">
                                                    <button type="button" @click="quantity = Math.max(1, quantity - 1)"
                                                        class="px-3 py-2 text-slate-500 hover:bg-slate-100 rounded-l-md transition">
                                                        <i class='bx bx-minus text-lg'></i>
                                                    </button>
                                                    <input type="text" :value="quantity" value="{{ $item->qty }}"
                                                        class="w-12 text-center text-lg font-bold border-none focus:ring-0 outline-none"
                                                        readonly>
                                                    <button type="button" @click="quantity++"
                                                        class="px-3 py-2 text-slate-500 hover:bg-slate-100 rounded-r-md transition">
                                                        <i class='bx bx-plus text-lg'></i>
                                                    </button>
                                                </div>
                                                <form action="{{ route('cart.update', $item->rowId) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                                    <input type="hidden" name="quantity" :value="quantity">
                                                    <button type="submit"
                                                        class="text-primary-600 font-semibold text-sm hover:underline"
                                                        :class="{ 'invisible': quantity == {{ $item->quantity }} }">Ubah</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="text-right flex flex-col items-end h-full">
                                            <p class="font-extrabold text-dark text-lg">Rp
                                                {{ number_format($item->price * $item->qty, 0, ',', '.') }}</p>
                                            <div class="flex-grow"></div>
                                            <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                                <button type="submit"
                                                    class="text-red-500 hover:text-red-700 transition-colors p-2 rounded-full hover:bg-red-50">
                                                    <i class='bx bxs-trash text-xl'></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-4">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 lg:sticky lg:top-28">
                            <h2 class="text-xl font-bold text-dark mb-4">Ringkasan Pesanan</h2>
                            <div class="space-y-3 text-slate-600">
                                <div class="flex justify-between"><span>Subtotal</span>
                                    <span class="font-semibold text-dark">Rp
                                        {{ Gloudemans\Shoppingcart\Facades\Cart::total(0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between"><span>Biaya Pengiriman</span>
                                    <span class="font-semibold text-dark">Akan dihitung</span>
                                </div>
                                <div
                                    class="flex justify-between pt-4 border-t border-slate-200 text-lg font-bold text-dark">
                                    <span>Total</span>
                                    <span>Rp
                                        {{ Gloudemans\Shoppingcart\Facades\Cart::total(0, ',', '.') }}</span>
                                </div>
                            </div>
                            <a href="#"
                                class="mt-6 w-full block text-center bg-primary-600 text-white py-3.5 rounded-lg text-lg font-bold hover:bg-primary-700 transition-colors">Lanjut
                                ke Checkout</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-16 px-6 bg-white rounded-2xl shadow-sm border border-slate-200">
                    <div class="max-w-md mx-auto">
                        <i class='bx bx-cart-alt text-6xl text-slate-300'></i>
                        <h3 class="mt-4 text-2xl font-bold text-dark">Keranjang Anda Kosong</h3>
                        <p class="mt-2 text-slate-500">Sepertinya Anda belum menambahkan produk apa pun. Ayo mulai
                            berbelanja!</p>
                        <a href="{{ route('products.index') }}"
                            class="inline-block mt-6 bg-primary-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-primary-700 transition-colors">Jelajahi
                            Produk</a>
                    </div>
                </div>
            @endif
        </section>
    </main>
@endsection
