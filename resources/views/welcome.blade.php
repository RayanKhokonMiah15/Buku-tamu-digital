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
            padding: 2rem;
            flex-wrap: wrap;
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
            WhistleSecure
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
            <h2>Welcome to WhistleSecure 🛡️</h2>
            <p>A secure and confidential platform for reporting misconduct anonymously.</p>
        </div>
        <div class="image-box">
            <img src="images/logo.png" alt="Image Box">
        </div>
    </main>

    <footer>
        &copy; {{ date('Y') }} WhistleSecure. All rights reserved.
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
