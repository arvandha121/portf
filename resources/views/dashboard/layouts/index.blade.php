<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portofolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home-layouts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/topbars.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer-layouts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skill.css') }}">
    <script src="{{ asset('js/main.js') }}"></script>
</head>

<body class="min-h-screen flex flex-col bg-gray-50">

    {{-- Navbar --}}
    @include('dashboard.layouts.partials.topbar')

    {{-- Social Icons --}}
    <div class="social-icons">
        @foreach ($sosmeds as $sosmed)
            <a href="{{ $sosmed->url }}" target="_blank" title="{{ $sosmed->platform }}">
                <i data-feather="{{ strtolower($sosmed->platform) }}"></i>
            </a>
        @endforeach
    </div>

    {{-- Konten utama --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('dashboard.layouts.partials.footer')

</body>

</html>
