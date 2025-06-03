<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Admin Layout Styles */
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            background: #1a1a1a;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar h4 {
            padding: 1.25rem;
            text-align: center;
            background: #2d2d2d;
            margin: 0;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .sidebar a {
            color: #ffffff;
            display: flex;
            align-items: center;
            padding: 0.875rem 1.25rem;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9375rem;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
            padding-left: 1.5rem;
        }

        .sidebar a i {
            margin-right: 0.75rem;
            font-size: 1rem;
            width: 1.25rem;
            text-align: center;
        }

        .sidebar form {
            padding: 1.25rem;
            margin-top: auto;
        }

        .sidebar button {
            background: #dc3545;
            border: none;
            padding: 0.75rem 1.25rem;
            border-radius: 0.375rem;
            color: white;
            font-weight: 500;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.2s ease;
            transition: background 0.3s;
            width: 100%; /* Tombol penuh di dalam sidebar */
        }

        .sidebar button:hover {
            background: #c0392b;
        }

        /* Main content area */
        .main-content {
            flex-grow: 1;
            padding: 30px;
            background: #f8f9fa;
        }

        .main-content h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: fixed;
                height: auto;
            }

            .main-content {
                margin-top: 250px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar navigasi admin -->
    <div class="sidebar">
        <div>
            <h4>Admin Panel</h4>

            <!-- Link ke halaman dashboard -->
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>

            <a href="{{route('guru.index')}}">
                <i class="fas fa-home"></i>Daftar Guru
            </a>
        </div>

        <!-- Tombol logout -->
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <!-- Tempat konten utama -->
    <div class="main-content">
        @yield('content') <!-- Tempat isi halaman -->
    </div>

</body>
</html>
