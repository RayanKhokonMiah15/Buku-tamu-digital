<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - {{ config('app.name', 'Whistleblower') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #3b82f6;
            --secondary-blue: #2563eb;
            --background-darker: #111827;
            --background-dark: #1f2937;
            --card-dark: rgba(17, 24, 39, 0.95);
            --text-light: #ffffff;
            --text-gray: #9ca3af;
            --border-dark: #374151;
            --navbar-gradient-start: #1e3a8a;
            --navbar-gradient-end: #1e40af;
        }

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, var(--navbar-gradient-start), var(--navbar-gradient-end));
            padding: 1.25rem 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff !important;
        }

        /* Logo and Brand Styles */
        .navbar-logo {
            height: 50px;
            width: auto;
            filter: drop-shadow(0 0 12px rgba(59, 130, 246, 0.4));
            transition: transform 0.3s ease;
            margin-right: 1rem;
        }

        .navbar-brand:hover .navbar-logo {
            transform: scale(1.08);
        }

        .navbar-brand {
            color: var(--text-light) !important;
            font-weight: 600;
            font-size: 1.4rem;
            transition: all 0.3s ease;
            padding: 0;
            margin-right: auto;
        }

        .navbar-brand span {
            color: #ffffff;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        body {
            background-color: var(--background-darker);
            color: var(--text-light);
            min-height: 100vh;
            background-image: 
                radial-gradient(at 40% 20%, rgba(59, 130, 246, 0.1) 0px, transparent 50%),
                radial-gradient(at 80% 0%, rgba(37, 99, 235, 0.1) 0px, transparent 50%),
                radial-gradient(at 0% 50%, rgba(59, 130, 246, 0.1) 0px, transparent 50%);
        }

        .dashboard-container {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .dashboard-title {
            color: var(--text-light);
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(45deg, var(--primary-blue), var(--secondary-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .reports-container {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        }

        .report-card {
            background: var(--card-dark);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-dark);
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
        }

        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(59, 130, 246, 0.2);
        }

        .report-content {
            padding: 1.5rem;
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
            gap: 1rem;
        }

        .report-info {
            flex: 1;
        }

        .report-date {
            color: var(--text-gray);
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .report-title {
            margin: 0.5rem 0;
            color: var(--text-light);
            font-size: 1.25rem;
            font-weight: 600;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            backdrop-filter: blur(8px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .status-badge.pending {
            background: rgba(194, 65, 12, 0.1);
            color: #fdba74;
            border: 1px solid rgba(194, 65, 12, 0.2);
        }

        .status-badge.process {
            background: rgba(29, 78, 216, 0.1);
            color: #93c5fd;
            border: 1px solid rgba(29, 78, 216, 0.2);
        }

        .status-badge.done {
            background: rgba(22, 160, 61, 0.1);
            color: #86efac;
            border: 1px solid rgba(22, 160, 61, 0.2);
        }

        .report-actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            margin-top: 1rem;
        }

        .btn-handle {
            background: var(--accent-blue);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .btn-handle:hover {
            background: var(--primary-blue);
        }

        .handling-info {
            margin-top: 1rem;
            padding: 0.75rem;
            background: #374151;
            border-radius: 6px;
            border: 1px solid #4b5563;
        }

        .handling-info-title {
            font-weight: 600;
            color: #e5e7eb;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .handling-info-content {
            color: #d1d5db;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .report-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #4b5563;
            font-size: 0.875rem;
            color: #9ca3af;
        }

        .report-meta-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            background: var(--card-dark);
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .empty-icon {
            width: 48px;
            height: 48px;
            color: #9ca3af;
            margin-bottom: 1rem;
        }

        .empty-text {
            color: #d1d5db;
            font-size: 1.125rem;
        }

        /* Image Viewer Modal */
        .image-viewer {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .close-button {
            position: absolute;
            top: 20px;
            right: 30px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }

        #expandedImage {
            max-width: 90%;
            max-height: 90vh;
            margin: auto;
        }

        .success-message {
            background-color: #10b981;
            color: white;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
        }

        .navbar {
            background-color: var(--primary-blue);
            padding: 1rem 2rem;
        }

        .navbar-brand {
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
        }

        .nav-link:hover {
            color: white;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('guru.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="WhistleBlower Logo" class="navbar-logo">
                <span>Dashboard Guru</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link">{{ Auth::guard('guru')->user()->username }}</span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('guru.logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
