<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    <header class="flex justify-between items-center px-6 py-4 border-b border-gray-700">
        <h1 class="text-2xl font-semibold">🌓 My Laravel App</h1>
        @if (Route::has('login'))
            <nav class="space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="hover:underline text-gray-300">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hover:underline text-gray-300">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="hover:underline text-gray-300">Register</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <main class="flex flex-1 flex-col items-center justify-center text-center px-6">
        <h2 class="text-4xl font-bold mb-4">Welcome to Your Dark Laravel App 🌌</h2>
        <p class="text-lg text-gray-400 max-w-xl">
            This is a simple and elegant starting point for your next big thing.
        </p>
    </main>

    <footer class="text-center text-sm text-gray-500 py-4 border-t border-gray-700">
        &copy; {{ date('Y') }} Fauzy's Project. All rights reserved.
    </footer>

</body>
</html>

