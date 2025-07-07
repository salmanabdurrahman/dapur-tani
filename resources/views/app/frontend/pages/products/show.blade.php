@extends('app.frontend.layouts.app')

@section('title', 'Jual Tomat Ceri Organik Dengan Kualitas Terbaik - Dapur Tani')

@section('content')
    <main class="py-12 md:py-16 my-20">
        <div class="container mx-auto px-4">
            <x-frontend.products.show.breadcrumb-section />
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16">
                <x-frontend.products.show.product-images-section />
                <x-frontend.products.show.product-information-section />
            </div>
            <x-frontend.products.show.product-details-section />
            <x-frontend.products.show.related-products-section />
        </div>
    </main>
@endsection
