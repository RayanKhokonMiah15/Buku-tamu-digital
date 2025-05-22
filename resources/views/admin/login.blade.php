<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin WhistleBlower Login</title>
    <style>
        /* Reset dan gaya dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
        }

        .login-container {
            background-color: #2d3748;
            width: 400px;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .login-container:hover {
            transform: scale(1.05);
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-size: 1.8em;
            color: #fff;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            font-weight: 600;
            font-size: 0.9em;
            margin-bottom: 5px;
            display: inline-block;
            color: #a0aec0;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            outline: none;
            background: #4a5568;
            color: white;
        }

        input[type="text"]::placeholder, input[type="password"]::placeholder {
            color: #cbd5e0;
        }

        .btn-login {
            width: 100%;
            padding: 12px 15px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
        }

        .form-footer {
            margin-top: 20px;
            font-size: 0.9em;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-footer label {
            cursor: pointer;
        }

        .form-footer a {
            color: #63b3ed;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .form-footer a:hover {
            color: #90cdf4;
        }

        .error-container {
            background-color: #e53e3e;
            padding: 10px;
            border-radius: 8px;
            color: white;
            font-size: 0.9em;
            margin-bottom: 20px;
        }

        .error-container ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Admin</h2>
        <!-- Tampilkan error kalau ada -->
        @if($errors->any())
            <div class="error-container">
                <ul>
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form login admin -->
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf <!-- Token proteksi form biar aman dari serangan CSRF -->

            <!-- Input username -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter your username" required>
            </div>

            <!-- Input password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
            </div>

            <!-- Tombol login -->
            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
</body>
</html>
