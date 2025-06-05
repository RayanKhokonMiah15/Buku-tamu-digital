
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Gradient latar belakang */
        body {
            background: linear-gradient(135deg, #1e1e1e 0%, #2a2a2a 100%);
        }

        /* Animasi bounce untuk teks 404 */
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-30px); }
            60% { transform: translateY(-15px); }
        }
        .animate-bounce-404 {
            animation: bounce 1s ease;
        }

        /* Animasi glitch untuk teks 404 */
        @keyframes glitch {
            0% { text-shadow: 0.05em 0 0 rgba(192, 38, 211, 0.75), -0.05em 0 0 rgba(107, 114, 128, 0.75); }
            14% { text-shadow: 0.05em 0 0 rgba(192, 38, 211, 0.75), -0.05em 0 0 rgba(107, 114, 128, 0.75); }
            15% { text-shadow: -0.05em -0.025em 0 rgba(192, 38, 211, 0.75), 0.025em 0.05em 0 rgba(107, 114, 128, 0.75); }
            49% { text-shadow: -0.05em -0.025em 0 rgba(192, 38, 211, 0.75), 0.025em 0.05em 0 rgba(107, 114, 128, 0.75); }
            50% { text-shadow: 0.025em 0.05em 0 rgba(192, 38, 211, 0.75), -0.05em 0 0 rgba(107, 114, 128, 0.75); }
            99% { text-shadow: 0.025em 0.05em 0 rgba(192, 38, 211, 0.75), -0.05em 0 0 rgba(107, 114, 128, 0.75); }
            100% { text-shadow: -0.025em 0 0 rgba(192, 38, 211, 0.75), -0.025em -0.025em 0 rgba(107, 114, 128, 0.75); }
        }
        .animate-glitch {
            animation: glitch 3s linear infinite;
        }

        /* Animasi fade-in untuk teks */
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 1s ease forwards;
        }

        /* Animasi pulse untuk tombol */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .animate-pulse-button {
            animation: pulse 2s infinite;
        }

        /* Animasi slide-up untuk footer */
        @keyframes slideUp {
            0% { transform: translateY(50px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
        .animate-slide-up {
            animation: slideUp 1s ease forwards;
        }

        /* Efek ripple untuk tombol */
        .ripple {
            position: relative;
            overflow: hidden;
        }
        .ripple::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.2);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1);
            transform-origin: 50% 50%;
            animation: ripple 0.6s linear;
        }
        @keyframes ripple {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(50); opacity: 0; }
        }

        /* Partikel latar belakang */
        .particle {
            position: absolute;
            background: linear-gradient(45deg, rgba(147, 51, 234, 0.3), rgba(107, 114, 128, 0.3));
            border-radius: 50%;
            animation: float 12s infinite linear;
        }
        @keyframes float {
            0% { transform: translateY(0) translateX(0); opacity: 0.6; }
            50% { opacity: 0.3; }
            100% { transform: translateY(-100vh) translateX(15px); opacity: 0; }
        }

        /* SVG animasi */
        .svg-icon {
            transition: transform 0.3s ease;
        }
        .svg-icon:hover {
            transform: scale(1.1) rotate(5deg);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Partikel latar belakang -->
    <div id="particles" class="absolute inset-0 pointer-events-none"></div>

    <div class="text-center px-4 z-10 max-w-2xl mx-auto">
        <div class="bg-[#262626]/80 backdrop-blur-sm rounded-2xl p-8 shadow-lg border border-[#333] mb-8">
            <!-- Ilustrasi SVG -->
            <div class="mb-6 flex justify-center">
                <svg class="svg-icon w-32 h-32 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 01.553-.894L9 2m0 18l6-3m-6 3V2m6 18l5.447-2.724A1 1 0 0021 16.382V5.618a1 1 0 00-.553-.894L15 2m0 18V2m0 0l-6 3"/>
                </svg>
            </div>

            <!-- Teks 404 dengan gradient dan glitch -->
            <h1 class="text-7xl sm:text-9xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-purple-400 mb-4 animate-bounce-404 animate-glitch" style="animation-delay: 0s">404</h1>
            <div class="text-gray-200 text-xl sm:text-2xl font-semibold mb-4 animate-fade-in" style="animation-delay: 0.5s">Halaman Tidak Ditemukan</div>
            <p class="text-gray-400 text-sm sm:text-base mb-8 animate-fade-in" style="animation-delay: 1s">Maaf, sepertinya Anda tersesat! Halaman yang Anda cari tidak ada atau telah dipindahkan.</p>

            <!-- Tombol -->
            <div class="flex flex-col sm:flex-row justify-center gap-4 animate-fade-in" style="animation-delay: 1.5s">
                <a href="{{ url()->previous() }}"
                   class="ripple inline-block bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 hover:shadow-xl transition-all duration-300 animate-pulse-button text-sm sm:text-base font-medium">
                    Kembali
                </a>
                <a href="{{ url('/') }}"
                   class="ripple inline-block bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-600 hover:shadow-xl transition-all duration-300 animate-pulse-button text-sm sm:text-base font-medium">
                    Ke Beranda
                </a>
            </div>

            <!-- Info error -->
            <div class="mt-8 text-gray-500 text-xs animate-fade-in" style="animation-delay: 2s">
                <p>Error Code: 404 | Page Not Found</p>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 w-full p-4 text-center text-gray-600 text-xs border-t border-[#333] animate-slide-up">
        <p>© {{ date('Y') }} WhistleBlower. All rights reserved.</p>
    </div>

    <script>
        // Membuat partikel latar belakang
        function createParticles() {
            const particleContainer = document.getElementById('particles');
            const particleCount = window.innerWidth < 640 ? 10 : 20; // Kurangi partikel di mobile

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.width = `${Math.random() * 6 + 3}px`;
                particle.style.height = particle.style.width;
                particle.style.left = `${Math.random() * 100}vw`;
                particle.style.top = `${Math.random() * 100}vh`;
                particle.style.animationDuration = `${Math.random() * 8 + 8}s`;
                particle.style.animationDelay = `${Math.random() * 4}s`;
                particleContainer.appendChild(particle);
            }
        }

        // Trigger ripple effect pada klik tombol
        document.querySelectorAll('.ripple').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                ripple.className = 'ripple';
                this.appendChild(ripple);
                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Jalankan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', createParticles);

        // Trigger animasi bounce 404 saat halaman dimuat
        window.addEventListener('load', () => {
            const error404 = document.querySelector('h1');
            error404.classList.remove('animate-bounce-404');
            void error404.offsetWidth; // Trigger reflow
            error404.classList.add('animate-bounce-404');
        });
    </script>
</body>
</html>

