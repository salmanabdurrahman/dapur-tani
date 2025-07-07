@extends('app.frontend.layouts.app')

@section('title', 'Jelajahi Produk Segar & Bahan Baku - Dapur Tani')

@section('content')
    <main class="py-12 md:py-16 my-20">
        <div class="container mx-auto px-4">
            <x-frontend.products.index.breadcrumb-section />
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-8 lg:items-start" x-data="{ filtersOpen: false }">
                <x-frontend.products.index.mobile-filter-section />
                <x-frontend.products.index.filter-section />
                <div class="lg:w-3/4">
                    <x-frontend.products.index.product-controls-section />
                    <x-frontend.products.index.product-grid-section />
                    <x-frontend.products.index.pagination-section />
                </div>
            </div>
        </div>
    </main>
@endsection
