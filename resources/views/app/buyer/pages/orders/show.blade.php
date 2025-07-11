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
                <a href="#"
                    class="bg-slate-200 text-dark font-bold px-4 py-2.5 rounded-lg hover:bg-slate-300 transition-colors flex items-center gap-2">
                    <i class='bx bxs-printer text-xl'></i><span>Cetak Invoice</span>
                </a>
                <a href="#"
                    class="bg-primary-600 text-white font-bold px-4 py-2.5 rounded-lg hover:bg-primary-700 transition-colors flex items-center gap-2">
                    <i class='bx bx-revision text-xl'></i><span>Pesan Lagi</span>
                </a>
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
                            'bx bxs-check-circle text-2xl' =>
                                $order->status === \App\Enums\OrderStatus::COMPLETED,
                            'bx bxs-x-circle text-2xl' =>
                                $order->status === \App\Enums\OrderStatus::CANCELLED,
                        ])></i>
                        <span>{{ Str::title(str_replace('_', ' ', $order->status->value)) }}</span>
                    </div>
                </div>
                @if ($order->status === App\Enums\OrderStatus::PENDING_PAYMENT && $order->snap_token)
                    <div class="border-t border-b border-slate-200 py-2">
                        <h3 class="font-bold text-dark mb-2">Aksi</h3>
                        <button id="pay-button"
                            class="w-full bg-primary-600 text-white font-bold px-4 py-3 rounded-lg hover:bg-primary-700 transition-colors flex items-center justify-center gap-2">
                            <i class='bx bxs-credit-card text-xl'></i><span>Bayar Sekarang</span>
                        </button>
                        <p class="text-xs text-slate-500 mt-2 text-center">Selesaikan pembayaran untuk melanjutkan pesanan.
                        </p>
                    </div>
                @endif
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
