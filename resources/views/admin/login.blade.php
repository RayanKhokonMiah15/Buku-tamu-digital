<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white flex items-center justify-center h-screen">
    <div class="bg-gray-800 p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4">Login Admin</h1>

        @if($errors->any())
            <div class="bg-red-600 p-2 rounded mb-4">
                <ul class="text-white text-sm">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="mb-4">
                <label class="block mb-1">Username</label>
                <input type="text" name="username" class="w-full rounded p-2 text-black" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Password</label>
                <input type="password" name="password" class="w-full rounded p-2 text-black" required>
            </div>
            <button class="bg-blue-600 hover:bg-blue-700 w-full py-2 rounded">Login</button>
        </form>
    </div>
</body>
</html>

