<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard - Dapur Tani')</title>
    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Boxicons --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Styles --}}
    @stack('styles')
</head>

<body class="bg-body font-jakarta-sans text-slate-700 antialiased">
    <div x-data="{ sidebarOpen: true }" class="flex min-h-screen">
        {{-- Sidebar --}}
        <x-buyer.sidebar />

        <section class="flex-1 flex flex-col">
            {{-- Header --}}
            <x-buyer.header />

            {{-- Content --}}
            <main class="flex-grow p-8 md:p-10">
                @yield('content')
            </main>

            {{-- Alert Message --}}
            @if (session()->all())
                <x-frontend.alert-message />
            @endif
        </section>
    </div>

    {{-- Scripts --}}
    @stack('scripts')
</body>

</html>
