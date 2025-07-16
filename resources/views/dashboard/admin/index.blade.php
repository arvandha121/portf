<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('page-title') - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="{{ asset('js/admin.js') }}"></script>
</head>

<body class="min-h-screen flex flex-col bg-gray-100">

    <div class="flex flex-1">

        {{-- Sidebar Desktop --}}
        @include('dashboard.admin.partials.sidebardesktop')

        <div class="flex-1 flex flex-col w-full">
            {{-- Topbar --}}
            @include('dashboard.admin.partials.topbar')

            {{-- Main Content --}}
            <main class="flex-1 p-6 mt-7">
                {{-- Ini hanya muncul di mobile --}}
                <h1 class="text-2xl font-semibold text-gray-800 mb-6 md:hidden">@yield('page-title')</h1>

                {{-- Konten dari masing-masing halaman --}}
                @yield('content')
            </main>

            {{-- Footer --}}
            @include('dashboard.admin.partials.footer')
        </div>
    </div>

    {{-- Sidebar Mobile --}}
    @include('dashboard.admin.partials.sidebarmobile')
</body>

</html>
