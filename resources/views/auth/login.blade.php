<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-100 to-white min-h-screen flex items-center justify-center px-4">
    <div class="login-box bg-white/90 shadow-2xl rounded-2xl w-full max-w-md p-8 md:p-10">
        <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-8">Selamat Datang 👋</h1>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" required autofocus
                    class="form-input w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required
                    class="form-input w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm" />
            </div>

            <div class="flex justify-between items-center text-sm">
                <label class="inline-flex items-center text-gray-600">
                    <input type="checkbox" name="remember" class="text-blue-600 mr-2">
                    Ingat saya
                </label>
                <a href="#" class="text-blue-600 hover:underline">Lupa Password?</a>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-150 ease-in-out">
                Login
            </button>
        </form>

        <p class="mt-6 text-sm text-center text-gray-500">
            Belum punya akun? <a href="#" class="text-blue-600 hover:underline font-medium">Daftar</a>
        </p>
    </div>
</body>

</html>
