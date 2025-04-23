<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Whistleblowing System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-white font-sans">

    <!-- Navbar -->
    <nav class="bg-indigo-900 text-white p-4 flex justify-between items-center">
        <div class="text-xl font-bold">Navbar</div>
        <div class="flex space-x-4">
            <button class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">Button 1</button>
            <button class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">Button 2</button>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto p-8">
        <section class="mb-8">
            <h1 class="text-3xl font-bold mb-2">Selamat datang</h1>
            <p class="text-lg">Di System Whistleblowing</p>
            <p class="text-lg">SMKN 1 GARUT</p>
            <nav>
                @if (Route::has('login'))
                    <form method="POST" action="{{ route('login') }}" style="display: inline;">
                        @csrf
                        <button type="submit">Log in</button>
                    </form>
                    @if (Route::has('register'))
                        <form method="POST" action="{{ route('register') }}" style="display: inline;">
                            @csrf
                            <button type="submit">Register</button>
                        </form>
                    @endif
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @endauth
                @endif
            </nav>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-bold mb-4">// section 2, buat penjelasan apa itu whistleblowing</h2>
            <div class="flex items-center mb-8">
                <img src="{{ asset('images/help-icon.png') }}" alt="Help Icon" class="w-16 h-16 mr-4">
                <div>
                    <p class="text-lg font-bold">Apa definisi whistleblowing?</p>
                    <p class="text-base">
                        Pelapor pelanggaran (bahasa Inggris: whistleblower), atau disingkat sebagai pelapor, adalah istilah bagi orang atau pihak yang merupakan karyawan, mantan karyawan, pekerja, atau anggota dari suatu institusi atau organisasi yang melaporkan suatu tindakan yang dianggap melanggar ketentuan kepada pihak yang berwenang. Secara umum, segala tindakan yang melanggar kebijakan besar meliputi korupsi, aliran dan pernyataan yang menjadi ancaman terhadap publik, keselamatan publik, privasi publik, hak asasi manusia, hak-hak sipil, hak-hak sukarelawan, seperti korupsi, pelanggaran atas keselamatan kerja, dan masih banyak lagi.
                    </p>
                </div>
            </div>
        </section>

        <section class="text-center">
            <h2 class="text-2xl font-bold mb-4">Kami ada di sini untuk membantu Anda!</h2>
            <img src="{{ asset('images/help-icon.png') }}" alt="Help Icon" class="w-16 h-16 mx-auto mb-4">
            <p class="text-lg">
                Jika Anda mendapatkan perlakuan tidak pantas dari siapapun itu di lingkungan sekolah, kami bisa bantu!
            </p>
            <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded mt-4">
                <a href="#" class="text-white">Buat Laporan</a>
            </button>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-indigo-900 text-white p-4 text-center">
        <p>Hubungi Kami</p>
        <p>&copy; {{ date('Y') }} Whistleblowing System</p>
    </footer>
</body>
</html>
