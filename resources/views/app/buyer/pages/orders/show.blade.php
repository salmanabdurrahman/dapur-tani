@extends('app.buyer.layouts.app')

@section('title', "Detail Pesanan #{$order->order_number} - Dapur Tani")

@push('styles')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
@endpush

@section('content')
    <section class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-dark">Detail Pesanan {{ $order->order_number }}</h1>
                <p class="text-slate-500 mt-1">Dipesan pada {{ $order->created_at->format('d F Y') }}</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('buyer.orders.invoice', $order) }}" target="_blank"
                    class="bg-slate-200 text-dark font-bold px-4 py-2.5 rounded-lg hover:bg-slate-300 transition-colors flex items-center gap-2">
                    <i class='bx bxs-printer text-xl'></i><span>Cetak Invoice</span>
                </a>
                {{-- <a href="#"
                    class="bg-primary-600 text-white font-bold px-4 py-2.5 rounded-lg hover:bg-primary-700 transition-colors flex items-center gap-2">
                    <i class='bx bx-revision text-xl'></i><span>Pesan Lagi</span>
                </a> --}}
            </div>
        </div>
    </section>
    <section class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <h2 class="text-xl font-bold text-dark mb-4">Rincian Produk</h2>
                <div class="space-y-4">
                    @foreach ($order->items as $item)
                        <div class="flex items-start gap-4 border-b border-slate-100 pb-4">
                            <img src="{{ Storage::url($item->product->main_image_path) }}" alt="{{ $item->product->name }}"
                                class="w-20 h-20 object-cover rounded-lg" loading="lazy">
                            <div class="flex-grow">
                                <p class="font-bold text-dark">{{ $item->product->name }}</p>
                                <p class="text-sm text-slate-500">Rp {{ number_format($item->price_per_unit, 0, ',', '.') }}
                                    x {{ $item->quantity }} {{ $item->product->unit }}</p>
                            </div>
                            <p class="font-semibold text-dark">Rp
                                {{ number_format($item->price_per_unit * $item->quantity, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <h2 class="text-xl font-bold text-dark mb-4">Ringkasan Pembayaran</h2>
                <div class="space-y-3 text-slate-600">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span class="font-semibold text-dark">Rp
                            {{ number_format($order->items->sum(fn($item) => $item->price_per_unit * $item->quantity), 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Biaya Operasional</span>
                        <span class="font-semibold text-dark">Rp
                            {{ number_format($order->total_amount - $order->items->sum(fn($item) => $item->price_per_unit * $item->quantity), 0, ',', '.') }}</span>
                    </div>
                    {{-- <div class="flex justify-between">
                        <span>Biaya Pengiriman</span>
                        <span class="font-semibold text-dark">Rp 25.000</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Diskon</span>
                        <span class="font-semibold text-primary-600">- Rp 30.000</span>
                    </div> --}}
                    <div class="flex justify-between pt-4 border-t border-slate-200 text-lg font-bold text-dark">
                        <span>Total Pembayaran</span>
                        <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 space-y-6 lg:sticky lg:top-28">
                <div>
                    <h3 class="font-bold text-dark mb-2">Status Pesanan</h3>
                    <div @class([
                        'font-bold px-4 py-2 rounded-lg flex items-center gap-3',
                        'bg-amber-100 text-amber-700' =>
                            $order->status === \App\Enums\OrderStatus::PROCESSING,
                        'bg-sky-100 text-sky-700' =>
                            $order->status === \App\Enums\OrderStatus::SHIPPED,
                        'bg-blue-100 text-blue-700' =>
                            $order->status === \App\Enums\OrderStatus::DELIVERED,
                        'bg-primary-100 text-primary-700' =>
                            $order->status === \App\Enums\OrderStatus::COMPLETED,
                        'bg-red-100 text-red-700' =>
                            $order->status === \App\Enums\OrderStatus::CANCELLED,
                        'bg-slate-100 text-slate-700' =>
                            $order->status === \App\Enums\OrderStatus::PENDING_PAYMENT,
                    ])>
                        <i @class([
                            'bx bxs-time-five text-2xl' =>
                                $order->status === \App\Enums\OrderStatus::PENDING_PAYMENT ||
                                $order->status === \App\Enums\OrderStatus::PROCESSING,
                            'bx bxs-truck text-2xl' =>
                                $order->status === \App\Enums\OrderStatus::SHIPPED,
                            'bx bxs-package text-2xl' =>
                                $order->status === \App\Enums\OrderStatus::DELIVERED,
                            'bx bxs-check-circle text-2xl' =>
                                $order->status === \App\Enums\OrderStatus::COMPLETED,
                            'bx bxs-x-circle text-2xl' =>
                                $order->status === \App\Enums\OrderStatus::CANCELLED,
                        ])></i>
                        <span>{{ Str::title(str_replace('_', ' ', $order->status->value)) }}</span>
                    </div>
                </div>
                <div class="border-t border-b border-slate-200 py-2">
                    <h3 class="font-bold text-dark mb-2">Aksi</h3>
                    @if ($order->status === \App\Enums\OrderStatus::PENDING_PAYMENT && $order->snap_token)
                        <button id="pay-button"
                            class="w-full bg-primary-600 text-white font-bold px-4 py-3 rounded-lg hover:bg-primary-700 transition-colors flex items-center justify-center gap-2">
                            <i class='bx bxs-credit-card text-xl'></i><span>Bayar Sekarang</span>
                        </button>
                        <p class="text-xs text-slate-500 mt-2 text-center">Selesaikan pembayaran untuk melanjutkan
                            pesanan.
                        </p>
                    @elseif ($order->status === \App\Enums\OrderStatus::COMPLETED)
                        @php
                            $hasBeenReviewed = $order
                                ->reviews()
                                ->where('user_id', auth()->id())
                                ->exists();
                        @endphp

                        @if ($hasBeenReviewed)
                            <div class="space-y-4">
                                <h4 class="font-semibold text-dark">Ulasan Anda</h4>
                                @foreach ($order->reviews()->where('user_id', auth()->id())->get() as $review)
                                    <div class="border rounded-lg p-3 bg-slate-50">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-xs font-bold text-dark">{{ $review->product->name }}</span>
                                            <div class="flex items-center gap-1 text-amber-400">
                                                <span>{{ $review->rating }}</span>
                                                <i class="bx bxs-star"></i>
                                            </div>
                                        </div>
                                        <p class="text-sm text-slate-700 italic">
                                            "{{ $review->comment ?? 'Tidak ada komentar' }}"</p>
                                    </div>
                                @endforeach
                                <p class="text-xs text-slate-500 mt-2 text-center">Terima kasih telah memberikan ulasan!</p>
                            </div>
                        @else
                            <button @click="reviewModalOpen = true"
                                class="w-full bg-amber-500 text-white font-bold px-4 py-3 rounded-lg hover:bg-amber-600 transition-colors flex items-center justify-center gap-2">
                                <i class='bx bxs-star text-xl'></i><span>Beri Ulasan</span>
                            </button>
                            <p class="text-xs text-slate-500 mt-2 text-center">Pesanan selesai. Silakan beri ulasan untuk
                                produk yang Anda terima.</p>
                        @endif
                    @else
                        <p class="text-sm text-slate-500">Tidak ada aksi yang tersedia untuk pesanan ini.</p>
                    @endif
                </div>
                <div>
                    <h3 class="font-bold text-dark mb-2">Alamat Pengiriman</h3>
                    <div class="text-slate-600 leading-relaxed">
                        <p class="font-semibold">{{ $order->buyer->name }}
                            {{ "({$order->buyer->profile->business_name})" ?? '' }}
                        </p>
                        <p>{{ $order->buyer->profile->phone_number }}</p>
                        <p>{{ $order->shipping_address }}</p>
                    </div>
                </div>
                {{-- <div>
                    <h3 class="font-bold text-dark mb-2">Lacak Pengiriman</h3>
                    <p class="text-sm text-slate-500 mb-5">No. Resi: <span
                            class="font-semibold text-dark">DPX123456789</span></p>
                    <a href="#"
                        class="w-full text-center bg-slate-200 text-dark font-bold px-4 py-2.5 rounded-lg hover:bg-slate-300 transition-colors">Lacak
                        di Sini</a>
                </div> --}}
            </div>
        </div>
    </section>
    {{-- Review Modal --}}
    <div x-show="reviewModalOpen" x-cloak class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4"
        x-transition.opacity>
        <div @click.away="reviewModalOpen = false"
            class="bg-white w-full max-w-2xl rounded-2xl shadow-xl p-8 transform transition-all" x-show="reviewModalOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100">
            <h2 class="text-2xl font-bold text-dark mb-4">Beri Ulasan untuk Pesanan {{ $order->order_number }}</h2>
            <form action="{{ route('buyer.orders.review.store', $order) }}" method="POST">
                @csrf
                <div class="space-y-6 max-h-[60vh] overflow-y-auto pr-4">
                    @foreach ($order->items as $item)
                        <div class="flex items-start gap-4 border-t border-slate-100 pt-6 first:pt-0">
                            <img src="{{ $item->product ? Storage::url($item->product->main_image_path) : 'https://via.placeholder.com/150' }}"
                                alt="{{ $item->product_name }}" class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                            <div class="flex-grow" x-data="{ rating: 0, hoverRating: 0 }">
                                <p class="font-bold text-dark">{{ $item->product_name }}</p>
                                <div class="flex items-center my-2" @mouseleave="hoverRating = 0">
                                    <template x-for="i in 5">
                                        <i @click="rating = i" @mouseenter="hoverRating = i"
                                            class="bx bxs-star text-3xl cursor-pointer"
                                            :class="(hoverRating >= i || rating >= i) ? 'text-amber-400' : 'text-slate-300'"></i>
                                    </template>
                                    <input type="hidden" name="reviews[{{ $item->product_id }}][rating]" x-model="rating"
                                        required>
                                </div>
                                <textarea name="reviews[{{ $item->product_id }}][comment]" rows="3"
                                    placeholder="Bagaimana pendapat Anda tentang produk ini?"
                                    class="w-full p-2 border border-primary-300 rounded-lg text-sm focus:ring-primary-500 focus:border-primary-500 focus:outline-primary-500"></textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-slate-200">
                    <button type="button" @click="reviewModalOpen = false"
                        class="bg-slate-100 text-dark font-bold px-6 py-2.5 rounded-lg hover:bg-slate-200">Batal</button>
                    <button type="submit"
                        class="bg-primary-600 text-white font-bold px-6 py-2.5 rounded-lg hover:bg-primary-700">Kirim
                        Ulasan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @if ($order->status === \App\Enums\OrderStatus::PENDING_PAYMENT && $order->snap_token)
        <script type="text/javascript">
            window.addEventListener('DOMContentLoaded', function() {
                const payButton = document.getElementById('pay-button');

                payButton.addEventListener('click', function() {
                    window.snap.pay('{{ $order->snap_token }}', {
                        onSuccess: function(result) {
                            window.location.href = "{{ route('buyer.orders.show', $order->id) }}";
                        },
                        onPending: function(result) {
                            // alert("Menunggu pembayaran Anda!");
                        },
                        onError: function(result) {
                            // alert("Pembayaran gagal!");
                        },
                        onClose: function() {
                            // alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                        }
                    });
                });
            });
        </script>
    @endif
@endpush
