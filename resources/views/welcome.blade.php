<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="html-tag" class="dark">
<head>
    <meta charset="UTF-8">
    <title>WhistleSecure - Secure Reporting Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* CSS Utama */
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 100px; /* Add padding for fixed header */
        }
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

        .modern-header {
            background: rgba(17, 24, 39, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-title {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-title img {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(59,130,246,0.1);
            transition: transform 0.3s ease;
        }

        .logo-title img:hover {
            transform: scale(1.05);
        }

        .brand-title {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 0.5px;
        }

        nav.navbar {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-button {
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .nav-button {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-button:hover {
            background: rgba(59, 130, 246, 0.2);
            transform: translateY(-1px);
        }

        .login-btn {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .register-btn {
            background: #3b82f6;
            color: white;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
        }

        .login-btn:hover {
            background: rgba(59, 130, 246, 0.2);
        }

        .register-btn:hover {
            background: #2563eb;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        nav.navbar.light-mode a {
            color: #374151;
        }

        nav.navbar.light-mode a:hover {
            color: #000000;
        }

        /* Scroll indicator for navigation links */
        nav.navbar a.active,
        .mobile-nav a.active {
            color: #3b82f6;
            font-weight: 600;
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
            position: relative;
            z-index: 1001;
            pointer-events: auto;
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
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s ease forwards, titleGlow 2s ease-in-out infinite alternate;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .light-mode .feature-card {
            background: rgba(255, 255, 255, 0.9);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(59, 130, 246, 0.2),
                transparent
            );
            transition: 0.5s;
        }

        .feature-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 12px 24px rgba(59, 130, 246, 0.3);
        }

        .feature-card:hover::before {
            left: 100%;
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
            transition: all 0.5s ease;
            position: relative;
            z-index: 1;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
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

        /* Mobile Navigation Styles */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: #9ca3af;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            transition: color 0.3s ease;
        }

        .mobile-menu-btn:hover {
            color: #3b82f6;
        }

        .mobile-nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: rgba(17, 24, 39, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            transition: all 0.3s ease-in-out;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .mobile-nav.show {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        body.nav-open {
            overflow: hidden;
            position: fixed;
            width: 100%;
            height: 100%;
        }

        .mobile-nav .nav-link {
            color: white;
            font-size: 1.25rem;
            text-decoration: none;
            padding: 1rem 2rem;
            border-radius: 0.5rem;
            width: 80%;
            max-width: 300px;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            transition: all 0.3s ease;
            transform: translateY(20px);
            opacity: 0;
        }

        .mobile-nav.show .nav-link {
            transform: translateY(0);
            opacity: 1;
        }

        .mobile-nav .nav-link:hover {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
            transform: scale(1.05);
        }

        .mobile-nav.light-mode {
            background-color: rgba(255, 255, 255, 0.85);
        }

        .mobile-nav.light-mode .nav-link {
            color: #1f2937;
            background: rgba(0, 0, 0, 0.05);
        }

        .mobile-nav.light-mode .nav-link:hover {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .close-menu {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: none;
            border: none;
            color: #fff;
            font-size: 2rem;
            cursor: pointer;
            padding: 0.5rem;
            transition: all 0.3s ease;
            z-index: 1001;
        }

        .close-menu:hover {
            transform: rotate(90deg);
            color: #3b82f6;
        }

        .light-mode .close-menu {
            color: #1f2937;
        }

        @media (max-width: 768px) {
            header {
                grid-template-columns: auto 1fr auto;
                padding: 1rem;
            }

            .logo-title {
                font-size: 1.2rem;
            }

            .logo-title img {
                width: 40px;
                height: 40px;
            }

            nav.navbar {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
                order: 3;
            }

            .mobile-nav {
                display: flex;
                padding: 6rem 2rem;
            }

            .mobile-nav .nav-link {
                margin: 0.5rem 0;
                transition-delay: calc(var(--i) * 0.1s);
            }

            .close-menu {
                top: 1rem;
                right: 1rem;
            }

            main {
                padding: 2rem 1rem;
                flex-direction: column;
            }

            .main-text {
                margin-right: 0;
                margin-bottom: 2rem;
                max-width: 100%;
            }

            .main-text h2 {
                font-size: 2rem;
                text-align: center;
            }

            .tagline {
                font-size: 1.2rem;
                text-align: center;
            }

            .description {
                padding: 1.5rem;
            }

            .features {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .feature-card {
                padding: 1.25rem;
            }

            .cta-section {
                margin-top: 1.5rem;
            }

            .cta-text {
                font-size: 1.1rem;
            }

            .cta-button {
                width: 100%;
                text-align: center;
                padding: 1rem;
            }

            .image-box {
                width: 100%;
                gap: 1.5rem;
            }

            .hero-image {
                max-width: 280px;
                margin: 0 auto;
            }

            .logo-description {
                padding: 1.5rem;
                margin: 0 1rem;
                text-align: center;
            }

            .logo-description h3 {
                font-size: 1.3rem;
            }

            .logo-description p {
                font-size: 1rem;
                margin-bottom: 0.75rem;
            }

            /* Improve mobile nav spacing */
            .mobile-nav {
                padding: 4rem 2rem;
            }

            .mobile-nav a {
                padding: 0.75rem 1.5rem;
                width: 100%;
                text-align: center;
                border-radius: 0.5rem;
                background: rgba(255, 255, 255, 0.1);
            }

            .mobile-nav a:hover {
                background: rgba(255, 255, 255, 0.2);
            }

            .light-mode .mobile-nav a {
                background: rgba(0, 0, 0, 0.05);
            }

            .light-mode .mobile-nav a:hover {
                background: rgba(0, 0, 0, 0.1);
            }
        }

        @media (max-width: 480px) {
            .main-text h2 {
                font-size: 1.75rem;
            }

            .tagline {
                font-size: 1.1rem;
            }

            .feature-card {
                padding: 1rem;
            }

            .hero-image {
                max-width: 240px;
            }

            .logo-description {
                padding: 1.25rem;
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

        #theme-toggle {
            z-index: 1001;
            position: relative;
        }

        .mobile-menu-btn {
            z-index: 1001;
            position: relative;
        }

        .mobile-nav {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(17, 24, 39, 0.95);
            backdrop-filter: blur(8px);
            z-index: 1000;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            opacity: 0;
            visibility: hidden;
        }

        .mobile-nav.show {
            display: flex;
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header class="modern-header">
        <div class="header-content">
            <div class="logo-title">
                <img src="{{ asset('images/logoptun.png') }}" alt="Logo">
                <span class="brand-title">Pengadilan Tata Usaha Negara Bandung</span>
            </div>
        </div>
    </header>

    <!-- Mobile Navigation -->
    <nav class="mobile-nav" id="mobile-nav">
        <button class="close-menu" id="close-menu">×</button>
        <a href="#home" class="nav-link" onclick="closeMenu()">Home</a>
        <a href="#about" class="nav-link" onclick="closeMenu()">About</a>
        @if (Route::has('login'))
            @auth
                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="nav-link">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                @endif
            @endauth
        @endif
    </nav>

    <!-- Main Content -->
    <main>
        <div id="home" class="main-text">
            <h2>Selamat Datang di</h2>
            <h2>PTUN Bandung</h2>
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
        <div id="about" class="image-box">
            <img src="images/logoptun.png" alt="WhistleSecure Logo" class="hero-image">
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
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('theme-toggle');
            const mobileNav = document.getElementById('mobile-nav');
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const closeMenuBtn = document.getElementById('close-menu');
            const body = document.body;

            // Initialize theme from localStorage
            const currentTheme = localStorage.getItem('theme') || 'dark';
            setTheme(currentTheme);

            function setTheme(theme) {
                if (theme === 'light') {
                    body.classList.add('light-mode');
                    themeToggle.classList.add('light-mode');
                    mobileNav.classList.add('light-mode');
                    themeToggle.textContent = '🌙';
                } else {
                    body.classList.remove('light-mode');
                    themeToggle.classList.remove('light-mode');
                    mobileNav.classList.remove('light-mode');
                    themeToggle.textContent = '☀️';
                }
                localStorage.setItem('theme', theme);
            }

            // Theme toggle
            themeToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                const newTheme = body.classList.contains('light-mode') ? 'dark' : 'light';
                setTheme(newTheme);
            });

            // Close menu function
            function closeMenu() {
                mobileNav.classList.remove('show');
                body.classList.remove('nav-open');
            }

            // Mobile menu toggle
            mobileMenuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                mobileNav.classList.add('show');
                body.classList.add('nav-open');

                // Add transition delays to nav links
                document.querySelectorAll('.mobile-nav .nav-link').forEach((link, index) => {
                    link.style.setProperty('--i', index);
                });
            });

            // Close menu button
            closeMenuBtn.addEventListener('click', (e) => {
                e.preventDefault();
                closeMenu();
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', (e) => {
                if (mobileNav.classList.contains('show') &&
                    !mobileNav.contains(e.target) &&
                    !mobileMenuBtn.contains(e.target)) {
                    closeMenu();
                }
            });

            // Handle navigation links
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const targetId = link.getAttribute('href');
                    if (targetId.startsWith('#')) {
                        const targetElement = document.getElementById(targetId.substring(1));
                        if (targetElement) {
                            closeMenu();
                            targetElement.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                    } else {
                        window.location.href = targetId;
                    }
                });
            });

            // Prevent scrolling when mobile menu is open
            document.body.addEventListener('touchmove', (e) => {
                if (body.classList.contains('nav-open')) {
                    e.preventDefault();
                }
            }, { passive: false });

            // Scroll spy for navigation
            window.addEventListener('scroll', () => {
                const scrollPosition = window.scrollY;
                document.querySelectorAll('section').forEach(section => {
                    const sectionTop = section.offsetTop - 100;
                    const sectionBottom = sectionTop + section.offsetHeight;
                    const id = section.getAttribute('id');

                    if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                        navLinks.forEach(link => {
                            link.classList.remove('active');
                            if (link.getAttribute('href') === `#${id}`) {
                                link.classList.add('active');
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
