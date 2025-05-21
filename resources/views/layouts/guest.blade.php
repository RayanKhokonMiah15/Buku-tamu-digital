<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#f4f4f4] dark:bg-[#121212] text-gray-800 dark:text-gray-300 transition-colors duration-300">

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            
    {{-- Logo --}}
            <div>
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-auto">
                </a>
            </div>

            {{-- Kotak konten --}}
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-[#1e1e1e] shadow-md overflow-hidden sm:rounded-lg border border-gray-200 dark:border-[#444]">
                {{ $slot }}
            </div>
        </div>

    </body>
</html>

