@extends('app.frontend.layouts.app')

@section('title', 'Selesaikan Pembayaran - Dapur Tani')

@push('styles')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
@endpush

@section('content')
    <main class="py-12 md:py-20 my-20">
        <section class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center py-16 px-6 bg-white rounded-2xl shadow-sm border border-slate-200">
                <i class='bx bxs-check-circle text-6xl text-primary-500'></i>
                <h1 class="text-3xl font-extrabold text-dark mt-4">Pesanan Berhasil Dibuat!</h1>
                <p class="mt-2 text-slate-500">Pesanan Anda dengan nomor <strong
                        class="text-dark">{{ $order->order_number }}</strong> telah kami terima. Segera selesaikan
                    pembayaran.</p>
                <button id="pay-button"
                    class="inline-block mt-8 bg-primary-600 text-white px-8 py-4 rounded-lg font-bold hover:bg-primary-700 transition-colors">Bayar
                    Sekarang</button>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script type="text/javascript">
        window.addEventListener('DOMContentLoaded', function() {
            const payButton = document.getElementById('pay-button');

            payButton.addEventListener('click', function() {
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        window.location.href = '/buyer/orders';
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
@endpush
