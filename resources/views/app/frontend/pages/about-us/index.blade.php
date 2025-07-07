@extends('app.frontend.layouts.app')

@section('title', 'Misi Kami: Membangun Ekosistem Pangan yang Adil - Dapur Tani')

@section('content')
    <main class="pt-20">
        <x-frontend.about-us.hero-section />
        <x-frontend.about-us.our-story-section />
        <x-frontend.about-us.our-values-section />
        <x-frontend.about-us.cta-section />
    </main>
@endsection
