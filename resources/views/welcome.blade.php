<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="html-tag" class="dark">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Default Styles */
        body {
            background-color: #1f2937; /* Dark Mode Background */
            color: #ffffff; /* Text Color for Dark Mode */
            margin: 0;
            font-family: Arial, sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
            min-height: 100vh;
        }

        /* Light Mode Styles */
        body.light-mode {
            background-color: #ffffff; /* Light Mode Background */
            color: #000000; /* Text Color for Light Mode */
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #4b5563; /* Border for Dark Mode */
        }

        header.light-mode {
            border-bottom: 1px solid #e5e7eb; /* Border for Light Mode */
        }

        nav a {
            text-decoration: none;
            color: #9ca3af; /* Link Color for Dark Mode */
            margin-right: 1rem;
        }

        nav.light-mode a {
            color: #374151; /* Link Color for Light Mode */
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 1rem;
        }

        footer {
            text-align: center;
            padding: 1rem;
            border-top: 1px solid #4b5563; /* Border for Dark Mode */
            font-size: 0.875rem;
            color: #9ca3af; /* Text Color for Dark Mode */
        }

        footer.light-mode {
            border-top: 1px solid #e5e7eb; /* Border for Light Mode */
            color: #6b7280; /* Text Color for Light Mode */
        }

        /* Button Styling */
        #theme-toggle {
            padding: 0.5rem 1rem;
            background-color: #374151; /* Button Background for Dark Mode */
            color: #facc15; /* Button Text for Dark Mode */
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        #theme-toggle:hover {
            background-color: #4b5563; /* Hover Background for Dark Mode */
        }

        #theme-toggle.light-mode {
            background-color: #f3f4f6; /* Button Background for Light Mode */
            color: #3b82f6; /* Button Text for Light Mode */
        }

        #theme-toggle.light-mode:hover {
            background-color: #e5e7eb; /* Hover Background for Light Mode */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <header>
        <h1 style="font-size: 1.5rem; font-weight: bold;">🌓 My Laravel App</h1>

        <!-- Nav Links -->
        <nav>
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

            <!-- Dark/Light Mode Toggle Button -->
            <button id="theme-toggle">🌙</button>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <h2 style="font-size: 2rem; font-weight: bold; margin-bottom: 1rem;">
            Welcome to Your Laravel App 🌌
        </h2>
        <p style="font-size: 1rem; max-width: 40rem; margin: 0 auto;">
            This is a simple and elegant starting point for your next big thing.
        </p>
    </main>

    <!-- Footer -->
    <footer>
        &copy; {{ date('Y') }} Fauzy's Project. All rights reserved.
    </footer>

    <!-- JavaScript untuk Toggle Dark Mode -->
    <script>
        const toggleBtn = document.getElementById('theme-toggle');
        const body = document.body;

        function setTheme(theme) {
            if (theme === 'dark') {
                body.classList.remove('light-mode');
                localStorage.setItem('theme', 'dark');
                toggleBtn.innerHTML = '🌙'; // Emoji dark mode
            } else {
                body.classList.add('light-mode');
                localStorage.setItem('theme', 'light');
                toggleBtn.innerHTML = '🌞'; // Emoji light mode
            }
        }

        // Cek tema saat halaman dimuat
        window.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme');

            if (savedTheme === 'dark') {
                setTheme('dark');
            } else if (savedTheme === 'light') {
                setTheme('light');
            } else {
                // Jika belum ada preferensi, gunakan preferensi sistem
                if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    setTheme('dark');
                } else {
                    setTheme('light');
                }
            }
        });

        // Event listener untuk tombol toggle
        toggleBtn.addEventListener('click', () => {
            const currentTheme = body.classList.contains('light-mode') ? 'light' : 'dark';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            setTheme(newTheme);
        });
    </script>
</body>
</html>
