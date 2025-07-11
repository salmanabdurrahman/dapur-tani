@extends('app.frontend.layouts.app')

@section('title', 'Proses Checkout - Dapur Tani')

@section('content')
    <main class="py-12 md:py-20 my-20">
        <section class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-extrabold text-dark tracking-tight mb-10">Proses Checkout</h1>
            <form action="{{ route('buyer.checkout.store') }}" method="POST">
                @csrf
                <div class="grid lg:grid-cols-12 gap-8 items-start">
                    <div class="lg:col-span-7 space-y-8">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                            <h2 class="text-xl font-bold text-dark mb-4">Alamat Pengiriman</h2>
                            <div class="text-slate-600 leading-relaxed">
                                <p class="font-semibold">{{ auth()->user()->name }}</p>
                                <p>{{ auth()->user()->profile->phone_number ?? 'Nomor HP belum diisi' }}</p>
                                <p>{{ auth()->user()->profile->address ?? 'Alamat belum diisi' }}</p>
                            </div>
                            <a href="{{ route('buyer.settings.edit', ['tab' => 'profile']) }}"
                                class="text-sm font-semibold text-primary-600 hover:underline mt-2 inline-block">Lengkapi
                                Data Diri</a>
                        </div>
                    </div>
                    <div class="lg:col-span-5">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 lg:sticky lg:top-28">
                            <h2 class="text-xl font-bold text-dark mb-4">Ringkasan Pesanan</h2>
                            <div class="space-y-3 text-slate-600">
                                <div class="flex justify-between"><span>Subtotal</span><span
                                        class="font-semibold text-dark">Rp
                                        {{ Gloudemans\Shoppingcart\Facades\Cart::total(0, ',', '.') }}</span>
                                </div>
                                <div
                                    class="flex justify-between pt-4 border-t border-slate-200 text-lg font-bold text-dark">
                                    <span>Total</span><span>Rp
                                        {{ Gloudemans\Shoppingcart\Facades\Cart::total(0, ',', '.') }}</span>
                                </div>
                            </div>
                            <button type="submit"
                                class="mt-6 w-full block text-center bg-primary-600 text-white py-3.5 rounded-lg text-lg font-bold hover:bg-primary-700 transition-colors">Buat
                                Pesanan & Bayar</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection
