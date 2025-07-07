@extends('app.frontend.layouts.app')

@section('title', $title ?? 'Masuk ke Akun Anda - Dapur Tani')

@section('content')
    <main class="max-w-5xl mx-auto py-12 md:py-16 my-20">
        <div class="grid lg:grid-cols-2 gap-0 shadow-2xl rounded-lg overflow-hidden">
            <x-frontend.auth.buyer.left-side-section />
            <x-frontend.auth.buyer.right-side-section :open-tab="$openTab" />
        </div>
    </main>
@endsection
