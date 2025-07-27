@extends('app.frontend.layouts.app')

@section('title', 'Insight & Tren Harga - Dapur Tani')

@push('styles')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endpush

@section('content')
    <main class="my-20">
        <section class="bg-white py-12 md:py-20 border-b border-slate-200">
            <div class="container mx-auto px-4 text-center">
                <div class="max-w-3xl mx-auto">
                    <p class="font-semibold text-primary-600">Dapur Tani Insights</p>
                    <h1 class="text-4xl md:text-6xl font-black text-dark mt-2 leading-tight tracking-tight">
                        Wawasan Pasar Agrikultur Terkini
                    </h1>
                    <p class="mt-6 text-lg text-slate-600 max-w-2xl mx-auto">
                        Analisis data dan tren harga komoditas utama langsung dari transaksi yang terjadi di platform kami,
                        membantu Anda mengambil keputusan bisnis yang lebih baik.
                    </p>
                </div>
            </div>
        </section>
        <section class="py-16" x-data="insightChart()">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                            <h2 class="text-xl font-bold text-dark mb-4">
                                Tren Harga Rata-rata: <span x-text="selectedProductName" class="text-primary-600"></span>
                            </h2>
                            <div id="priceChart"></div>
                        </div>
                    </div>
                    <div class="lg:col-span-1">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                            <h2 class="text-xl font-bold text-dark mb-4">Pilih Produk untuk Melihat Trennya</h2>
                            <div class="space-y-2">
                                @forelse ($popularProducts as $product)
                                    <button @click="updateChart({{ $product->id }})"
                                        :class="{
                                            'bg-primary-50 ring-2 ring-primary-500': selectedProductId ===
                                                {{ $product->id }},
                                            'hover:bg-slate-50': selectedProductId !==
                                                {{ $product->id }}
                                        }"
                                        class="w-full flex items-center gap-4 p-3 rounded-lg transition-all text-left">
                                        <img src="{{ Storage::url($product->main_image_path) }}" alt="{{ $product->name }}"
                                            class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                                        <div>
                                            <p class="font-bold text-dark">{{ $product->name }}</p>
                                            <p class="text-sm text-slate-500">{{ $product->sales_count }}
                                                {{ $product->unit }} terjual</p>
                                        </div>
                                    </button>
                                @empty
                                    <p class="text-slate-500">Data produk terpopuler belum tersedia.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        function insightChart() {
            return {
                chart: null,
                trendsData: @json($trendsData),
                selectedProductId: {{ $popularProducts->first()->id ?? 'null' }},
                selectedProductName: '{{ $initialChartData['name'] }}',

                init() {
                    const initialData = @json($initialChartData);

                    let options = {
                        series: [{
                            name: "Harga Rata-rata",
                            data: initialData.data
                        }],
                        chart: {
                            height: 350,
                            type: 'area',
                            toolbar: {
                                show: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2
                        },
                        xaxis: {
                            categories: initialData.labels
                        },
                        yaxis: {
                            labels: {
                                formatter: (value) => "Rp " + new Intl.NumberFormat('id-ID').format(value)
                            }
                        },
                        tooltip: {
                            x: {
                                format: 'MMM yyyy'
                            },
                            y: {
                                formatter: (value) => "Rp " + new Intl.NumberFormat('id-ID').format(value)
                            }
                        },
                        colors: ['#16a34a'],
                    };

                    this.chart = new ApexCharts(document.querySelector("#priceChart"), options);
                    this.chart.render();
                },

                updateChart(productId) {
                    if (!this.trendsData[productId]) return;

                    const newTrend = this.trendsData[productId];
                    this.selectedProductId = productId;
                    this.selectedProductName = newTrend.name;

                    this.chart.updateOptions({
                        xaxis: {
                            categories: newTrend.labels
                        },
                        // title: {
                        //     text: 'Tren Harga Rata-rata: ' + newTrend.name,
                        // }
                    });

                    this.chart.updateSeries([{
                        name: 'Harga Rata-rata',
                        data: newTrend.data
                    }]);
                }
            }
        }
    </script>
@endpush
