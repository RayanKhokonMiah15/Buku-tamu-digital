<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 15px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .main-content {
            flex-grow: 1;
            padding: 30px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="p-3">Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger w-100 m-2">Logout</button>
        </form>
    </div>
    <div class="main-content">
        @yield('content')
    </div>
</body>
</html>

