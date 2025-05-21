<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    <!-- Import Bootstrap buat styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Layout biar sidebar sama konten sejajar horizontal */
        body {
            display: flex;
            min-height: 100vh; /* Biar full tinggi layar */
        }

        /* Styling sidebar admin */
        .sidebar {
            width: 250px;
            background: #343a40; /* Warna gelap khas admin panel */
            color: white;
        }

        /* Link dalam sidebar */
        .sidebar a {
            color: white;
            display: block;
            padding: 15px;
            text-decoration: none;
        }

        /* Efek hover link sidebar */
        .sidebar a:hover {
            background: #495057;
        }

        /* Area utama tempat tampilin konten halaman */
        .main-content {
            flex-grow: 1; /* Biar lebar ngikutin sisa ruang */
            padding: 30px;
        }
    </style>
</head>
<body>

    <!-- Sidebar navigasi admin -->
    <div class="sidebar">
        <h4 class="p-3">Admin Panel</h4>

        <!-- Link ke halaman dashboard admin -->
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>

        <!-- Tombol logout admin -->
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger w-100 m-2">Logout</button>
        </form>
    </div>

    <!-- Tempat tampilin konten dari setiap halaman -->
    <div class="main-content">
        @yield('content') <!-- Ini bakal diganti isi dari tiap view -->
    </div>

</body>
</html>

