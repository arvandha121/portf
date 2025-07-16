<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portofolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/home-layouts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/topbars.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer-layouts.css') }}">
</head>

<body class="min-h-screen flex flex-col">

    {{-- Navbar --}}
    @include('dashboard.layouts.partials.topbar')

    {{-- Konten utama --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('dashboard.layouts.partials.footer')

</body>

</html>
