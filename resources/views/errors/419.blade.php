<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - Halaman Kadaluarsa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#1e1e1e] min-h-screen flex items-center justify-center">
    <div class="text-center px-4">
        <div class="mb-8">
            <h1 class="text-9xl font-bold text-purple-600 mb-4">419</h1>
            <div class="text-gray-300 text-xl mb-6">Halaman Kadaluarsa</div>
            <p class="text-gray-400 mb-8">
                Maaf, sesi Anda telah berakhir. Silakan muat ulang halaman dan coba lagi.
                <br>
                <span class="text-sm text-gray-500">Ini biasanya terjadi karena alasan keamanan atau sesi yang telah kadaluarsa.</span>
            </p>
        </div>

        <div class="space-y-4">
            <button onclick="window.location.reload()"
                    class="inline-block bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition-colors mr-4">
                Muat Ulang
            </button>
            <a href="{{ url('/') }}"
               class="inline-block bg-gray-700 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                Ke Beranda
            </a>
        </div>

        <div class="mt-12 text-gray-500">
            <p>Error Code: 419 | Page Expired</p>
        </div>
    </div>

    <div class="absolute bottom-0 w-full p-4 text-center text-gray-600">
        <p>&copy; {{ date('Y') }} WhistleBlower. All rights reserved.</p>
    </div>
</body>
</html>
