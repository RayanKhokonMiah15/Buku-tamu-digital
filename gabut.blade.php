<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col font-poppins">

    <!-- Navbar -->
    <header class="bg-indigo-900 px-6 py-4 border-b border-gray-700">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-semibold">Navbar</h1>
            @if (Route::has('login'))
                <nav class="space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="hover:underline text-gray-300 transition-colors duration-300">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="hover:underline text-gray-300 transition-colors duration-300">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="hover:underline text-gray-300 transition-colors duration-300">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>

   <!-- Main Content -->
    <main class="flex flex-1 flex-col items-center justify-center text-center px-6">
        <section class="mb-8">
            <h1 class="text-4xl font-bold mb-4 text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500">Selamat datang</h1>
            <p class="text-lg text-gray-300">Di System Whistleblowing</p>
            <p class= "text-lg text-gray-300">SMKN 1 GARUT</p>
        </section>

        <section class="mb-8 max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold mb-4 text-indigo-400">// Apa itu whistleblowing?</h2>
            <div class="flex items-center mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="Help Icon" class="w-20 h-20 mr-6 rounded-full">
                <div>
                    <p class="text-lg font-medium text-gray-200">Apa definisi whistleblowing?</p>
                    <p class="text-base text-gray-400">
                        Pelapor pelanggaran (bahasa Inggris: whistleblower), atau disingkat sebagai pelapor, adalah istilah bagi orang atau pihak yang merupakan karyawan, mantan karyawan, pekerja, atau anggota dari suatu institusi atau organisasi yang melaporkan suatu tindakan yang dianggap melanggar ketentuan kepada pihak yang berwenang. Secara umum, segala tindakan yang melanggar kebijakan besar meliputi korupsi, aliran dan pernyataan yang menjadi ancaman terhadap publik, keselamatan publik, privasi publik, hak asasi manusia, hak-hak sipil, hak-hak sukarelawan, seperti korupsi, pelanggaran atas keselamatan kerja, dan masih banyak lagi.
                    </p>
                </div>
            </div>
        </section>

        <section class="text-center">
            <h2 class="text-3xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-orange-500">Kami ada di sini untuk membantu Anda!</h2>
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-20 h-20 mx-auto mb-6 rounded-full">
            <p class="text-lg text-gray-300">
                Jika Anda mendapatkan perlakuan tidak pantas dari siapapun itu di lingkungan sekolah, kami bisa bantu!
            </p>
            <button class="mt-6 bg-gradient-to-r from-red-600 to-orange-500 hover:from-red-700 hover:to-orange-600 text-white px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-white">Buat Laporan</a>
                @else
                    <a href="{{ route('login') }}" class="text-white">Login untuk Buat Laporan</a>
                @endauth
            </button>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-indigo-900 text-white p-6 text-center">
        <p class="text-sm text-gray-300">Hubungi Kami</p>
        <p class="text-sm text-gray-400">&copy; {{ date('Y') }} Whistleblowing System</p>
    </footer>
</body>
</html>
