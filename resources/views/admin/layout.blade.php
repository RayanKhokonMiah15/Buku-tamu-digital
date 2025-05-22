<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Import Bootstrap dan Font Awesome untuk styling dan ikon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Body styling untuk tampilan full height */
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }

        /* Sidebar styling */
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: #ecf0f1;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Biar tombol logout di bagian bawah */
        }

        .sidebar h4 {
            padding: 20px;
            text-align: center;
            background: #34495e;
            margin: 0;
        }

        .sidebar a {
            color: #ecf0f1;
            display: flex;
            align-items: center;
            padding: 15px 20px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background: #1abc9c;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar form {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .sidebar button {
            background: #e74c3c;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
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
