<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - {{ config('app.name', 'Whistleblower') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #0a2463;
            --secondary-blue: #3e92cc;
            --accent-blue: #1e88e5;
            --light-blue: #d6f1ff;
        }

        .dashboard-container {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .dashboard-title {
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .reports-container {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        }

        .report-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
        }

        .report-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
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
            color: #666;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .report-title {
            margin: 0.5rem 0;
            color: #333;
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
        }

        .status-badge.pending {
            background-color: #fff7ed;
            color: #c2410c;
            border: 1px solid #fdba74;
        }

        .status-badge.process {
            background-color: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #93c5fd;
        }

        .status-badge.done {
            background-color: #f0fdf4;
            color: #15803d;
            border: 1px solid #86efac;
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
            background: #f8fafc;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        .handling-info-title {
            font-weight: 600;
            color: #64748b;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .handling-info-content {
            color: #334155;
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
            border-top: 1px solid #e5e7eb;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .report-meta-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .empty-icon {
            width: 48px;
            height: 48px;
            color: #9ca3af;
            margin-bottom: 1rem;
        }

        .empty-text {
            color: #6b7280;
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
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('guru.dashboard') }}">Dashboard Guru</a>
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
    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openImageViewer(imgSrc) {
            document.getElementById("imageViewer").style.display = "flex";
            document.getElementById("expandedImage").src = imgSrc;
        }

        function closeImageViewer() {
            document.getElementById("imageViewer").style.display = "none";
        }
    </script>
    @stack('scripts')
</body>
</html>
