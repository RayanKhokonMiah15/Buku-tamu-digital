<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="html-tag" class="dark">
<head>
    <meta charset="UTF-8">
    <title>WhistleSecure - Secure Reporting Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* CSS Utama */
        body {
            background-color: #1f2937;
            color: #ffffff;
            margin: 0;
            font-family: Arial, sans-serif;
            transition: background-color 0.5s ease, color 0.5s ease;
            min-height: 100vh;
        }

        body.light-mode {
            background-color: #ffffff;
            color: #000000;
        }

        header {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            padding: 1rem 2rem;
            border-bottom: 1px solid #4b5563;
            background-color: #111827;
            transition: background-color 0.5s ease, border-color 0.5s ease, color 0.5s ease;
        }

        header.light-mode {
            background-color: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
            color: #000000;
        }

        .logo-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: bold;
            justify-self: start;
            transition: color 0.5s ease;
        }

        .logo-title img {
            width: 60px;
            height: 60px;
        }

        nav.navbar {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            justify-self: center;
            transition: color 0.5s ease;
        }

        nav.navbar a {
            text-decoration: none;
            color: #9ca3af;
            font-weight: 500;
            transition: color 0.5s ease;
        }

        nav.navbar a:hover {
            color: #ffffff;
        }

        nav.navbar.light-mode a {
            color: #374151;
        }

        nav.navbar.light-mode a:hover {
            color: #000000;
        }

        #theme-toggle {
            padding: 0.4rem 0.8rem;
            background-color: #374151;
            color: #facc15;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: background-color 0.5s ease, color 0.5s ease, transform 0.3s ease;
            justify-self: end;
        }

        #theme-toggle:hover {
            background-color: #4b5563;
            transform: scale(1.1);
        }

        #theme-toggle.light-mode {
            background-color: #f3f4f6;
            color: #3b82f6;
        }

        #theme-toggle.light-mode:hover {
            background-color: #e5e7eb;
            transform: scale(1.1);
        }

        main {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 4rem 2rem;
            flex-wrap: wrap;
            max-width: 1400px;
            margin: 0 auto;
        }

        .main-text {
            flex: 1;
            max-width: 600px;
            margin-right: 2rem;
        }

        .main-text h2 {
            font-size: 3rem;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, #3b82f6, #2563eb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: titleGlow 2s ease-in-out infinite alternate;
        }

        @keyframes titleGlow {
            from {
                filter: drop-shadow(0 0 2px rgba(59, 130, 246, 0.5));
            }
            to {
                filter: drop-shadow(0 0 5px rgba(59, 130, 246, 0.8));
            }
        }

        .tagline {
            font-size: 1.5rem;
            color: #9ca3af;
            margin-bottom: 2rem;
            font-weight: 300;
        }

        .description {
            background: rgba(55, 65, 81, 0.5);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .light-mode .description {
            background: rgba(243, 244, 246, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .feature-card {
            padding: 1.5rem;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 0.75rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .light-mode .feature-card {
            background: rgba(255, 255, 255, 0.9);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .feature-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            display: block;
        }

        .feature-card h3 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: #3b82f6;
        }

        .cta-section {
            text-align: center;
            margin-top: 2rem;
        }

        .cta-text {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            color: #9ca3af;
        }

        .cta-button {
            display: inline-block;
            padding: 1rem 2rem;
            background: linear-gradient(45deg, #3b82f6, #2563eb);
            color: white;
            text-decoration: none;
            border-radius: 0.5rem;
            font-weight: bold;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .image-box {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            gap: 2rem;
        }

        .logo-description {
            background: rgba(55, 65, 81, 0.5);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            max-width: 500px;
        }

        .light-mode .logo-description {
            background: rgba(243, 244, 246, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .logo-description h3 {
            font-size: 1.5rem;
            color: #3b82f6;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        .logo-description p {
            color: #9ca3af;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .light-mode .logo-description p {
            color: #4b5563;
        }

        .hero-image {
            max-width: 400px;
            height: auto;
            border-radius: 2rem;
            transition: transform 0.5s ease;
            position: relative;
            z-index: 1;
        }

        .image-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0) 70%);
            filter: blur(40px);
            z-index: 0;
        }

        @media (max-width: 1024px) {
            main {
                flex-direction: column;
                text-align: center;
            }

            .main-text {
                margin-right: 0;
                margin-bottom: 3rem;
            }

            .features {
                grid-template-columns: 1fr;
            }
        }

        footer {
            text-align: center;
            padding: 1rem;
            border-top: 1px solid #4b5563;
            font-size: 0.875rem;
            color: #9ca3af;
            transition: border-color 0.5s ease, color 0.5s ease;
        }

        footer.light-mode {
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
        }

        /* Styling untuk Pop-Up */
        #popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: #ffffff;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease, visibility 0.5s ease, transform 0.5s ease;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
        }

        #popup.visible {
            opacity: 1;
            visibility: visible;
            transform: translate(-50%, -50%) scale(1);
        }

        #popup.hidden {
            opacity: 0;
            visibility: hidden;
            transform: translate(-50%, -50%) scale(0.9);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header>
        <div class="logo-title">
            <img src="images/logo.png" alt="Logo">
            WhistleBlower
        </div>
        <nav class="navbar">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            @endif
        </nav>
        <button id="theme-toggle">🌙</button>
    </header>

    <!-- Main Content -->
    <main>
        <div class="main-text">
            <h2>Welcome to WhistleBlower 🛡️</h2>
            <p class="tagline">Memberdayakan Kebenaran, Melindungi Integritas.</p>
            <div class="description">
                <p>Platform terpercaya Anda untuk pelaporan rahasia dan transparansi organisasi.</p>
                <div class="features">
                    <div class="feature-card">
                        <span class="feature-icon">🔒</span>
                        <h3>Dijamin Anonimitas</h3>
                        <p>Enkripsi canggih memastikan identitas anda tetap terlindungi</p>
                    </div>
                    <div class="feature-card">
                        <span class="feature-icon">⚖️</span>
                        <h3>Pelaporan Etis</h3>
                        <p>Dukung transparansi dan akuntabilitas di organisasi anda</p>
                    </div>
                    <div class="feature-card">
                        <span class="feature-icon">🔍</span>
                        <h3>Investigasi yang Aman</h3>
                        <p>Penanganan laporan secara profesional dengan kerahasiaan yang lengkap</p>
                    </div>
                    <div class="feature-card">
                        <span class="feature-icon">📊</span>
                        <h3>Tracking Progress</h3>
                        <p>Pantau status dan perkembangan laporan Anda secara real-time</p>
                    </div>
                </div>
                <div class="cta-section">
                    <p class="cta-text">Buat perbedaan hari ini. Suara Anda penting.</p>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="cta-button">Get Started</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="image-box">
            <img src="images/logo.png" alt="WhistleSecure Logo" class="hero-image">
            <div class="image-overlay"></div>
            <div class="logo-description">
                <h3>Apa itu WhistleBlower?</h3>
                <p>WhistleBlower adalah platform pelaporan digital yang aman dan terpercaya, dirancang khusus untuk melindungi individu yang berani mengungkap praktik-praktik tidak etis, kecurangan, atau pelanggaran dalam organisasi.</p>
                <p>Dengan teknologi enkripsi terkini dan sistem manajemen laporan yang canggih, kami memastikan setiap laporan ditangani dengan profesional sambil menjaga kerahasiaan total pelapor.</p>
            </div>
        </div>
    </main>

    <footer>
        &copy; {{ date('Y') }} WhistleBlower. All rights reserved.
    </footer>

    <!-- Pop-Up Elemen -->
    <div id="popup"></div>

    <!-- Audio Element -->
    <audio id="dark-mode-sound" src="sounds/dark-mode.mp3"></audio>
    <audio id="light-mode-sound" src="sounds/light-mode.mp3"></audio>

    <script>
        const toggleBtn = document.getElementById('theme-toggle');
        const body = document.body;
        const popup = document.getElementById('popup');
        const header = document.querySelector('header');
        const navbar = document.querySelector('nav.navbar');

        // Audio elements
        const darkModeSound = document.getElementById('dark-mode-sound');
        const lightModeSound = document.getElementById('light-mode-sound');

        function setTheme(theme) {
            if (theme === 'dark') {
                body.classList.remove('light-mode');
                header.classList.remove('light-mode');
                navbar.classList.remove('light-mode');
                toggleBtn.textContent = '🌙';
                localStorage.setItem('theme', 'dark');
                showPopup("Selamat datang di kegelapan");
                playSound(darkModeSound); // Mainkan suara dark mode
            } else {
                body.classList.add('light-mode');
                header.classList.add('light-mode');
                navbar.classList.add('light-mode');
                toggleBtn.textContent = '🌞';
                localStorage.setItem('theme', 'light');
                showPopup("Selamat datang di pencerahan");
                playSound(lightModeSound); // Mainkan suara light mode
            }
        }

        // Fungsi untuk menampilkan pop-up
        function showPopup(message) {
            popup.textContent = message;
            popup.classList.add('visible');

            // Hilangkan pop-up setelah 2 detik
            setTimeout(() => {
                popup.classList.remove('visible');
                popup.classList.add('hidden');
                setTimeout(() => {
                    popup.classList.remove('hidden');
                }, 500); // Sinkronkan dengan durasi transisi
            }, 2000);
        }

        // Fungsi untuk memainkan suara
        function playSound(audioElement) {
            audioElement.currentTime = 0; // Mulai ulang suara jika sudah dimainkan
            audioElement.play();
        }

        window.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                setTheme('dark');   
            } else if (savedTheme === 'light') {
                setTheme('light');
            } else {
                setTheme(window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            }
        });

        toggleBtn.addEventListener('click', () => {
            const isLight = body.classList.contains('light-mode');
            setTheme(isLight ? 'dark' : 'light');
        });
    </script>
</body>
</html>
