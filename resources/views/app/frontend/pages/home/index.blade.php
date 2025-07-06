@extends('app.frontend.layouts.app')

@section('title', 'Beranda - Dapur Tani')

@push('styles')
    <style>
        .marquee-container {
            overflow: hidden;
            position: relative;
        }

        .marquee-content {
            display: flex;
            width: max-content;
            animation: marquee 45s linear infinite;
        }

        .marquee-content:hover {
            animation-play-state: paused;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }
    </style>
@endpush

@section('content')
    <main class="pt-20">
        <x-frontend.home.hero-section />
        <x-frontend.home.category-navigation-section />
        <x-frontend.home.why-choose-section />
        <x-frontend.home.target-audience-section />
        <x-frontend.home.testimonial-section />
        <x-frontend.home.cta-section />
    </main>
@endsection
