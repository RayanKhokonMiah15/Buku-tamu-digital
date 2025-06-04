<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Guru | Digital Learning</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --primary-blue: #0a2463;
            --secondary-blue: #3e92cc;
            --accent-blue: #1e88e5;
            --light-blue: #d6f1ff;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('https://i.pinimg.com/736x/d7/27/01/d72701f83b1fb5d7bcd655ea7d75e7ec.jpg') no-repeat center center fixed;
            background-size: cover;
            position: relative;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -2;
            background: inherit;
            background-size: cover;
            background-position: center;
            filter: blur(8px);
            pointer-events: none;
        }

        .login-container {
            background: rgba(30, 30, 30, 0.7);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            width: 100%;
            max-width: 500px;
            position: relative;
            overflow: hidden;
            z-index: 1;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transform-style: preserve-3d;
            transition: all 0.5s ease;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(62,146,204,0.1) 0%, rgba(10,36,99,0) 70%);
            z-index: -1;
            animation: rotate 15s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .login-title {
            font-weight: 700;
            color: #f1f1f1;
            text-shadow: 0 2px 8px rgba(0,0,0,0.25);
            margin-bottom: 2rem;
            text-align: center;
            font-size: 2rem;
            position: relative;
            display: inline-block;
        }

        .login-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--accent-blue);
            border-radius: 2px;
        }

        /* Input Fields Styling */
        .form-floating {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-floating .form-control {
            background: rgba(255, 255, 255, 0.15) !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            border-radius: 8px !important;
            color: #ffffff !important;
            padding-left: 2.5rem !important;
            box-shadow: none !important;
            transition: all 0.3s ease !important;
            height: calc(3.5rem + 2px);
        }

        .form-floating .form-control:focus {
            border: 1px solid var(--accent-blue) !important;
            background: rgba(255, 255, 255, 0.2) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(30, 146, 204, 0.2) !important;
            transform: translateY(-2px);
        }

        .form-floating label {
            left: 2.5rem !important;
            color: rgba(255, 255, 255, 0.8) !important;
            background: transparent !important;
            padding: 1rem 0.75rem 0.5rem 0 !important;
            font-size: 1rem !important;
            pointer-events: none !important;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55) !important;
        }

        .form-floating input:not(:placeholder-shown) ~ label,
        .form-floating input:focus ~ label {
            transform: scale(0.85) translateY(-1.5rem) translateX(0.15rem) !important;
            color: var(--light-blue) !important;
            background: transparent !important;
            padding: 0 0.5rem !important;
        }

        .form-floating .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.2rem;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .form-floating .form-control:focus ~ .input-icon {
            color: var(--accent-blue);
            transform: translateY(-50%) scale(1.1);
        }

        /* Autofill Styling Fix */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 1000px rgba(40, 40, 40, 0.8) inset !important;
            -webkit-text-fill-color: #ffffff !important;
            background: rgba(255, 255, 255, 0.15) !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            color: #ffffff !important;
            caret-color: white !important;
            border-radius: 8px !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        input:-webkit-autofill::first-line {
            color: #ffffff !important;
            font-size: 1rem !important;
        }

        .btn-login {
            background: linear-gradient(90deg, #3e92cc 0%, #1e88e5 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            margin-top: 1rem;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            background: linear-gradient(90deg, #1e88e5 0%, #3e92cc 100%);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(10, 36, 99, 0.3);
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            border-radius: 50%;
            background: var(--light-blue);
            animation: float 6s ease-in-out infinite alternate;
        }

        .shape-1 {
            width: 150px;
            height: 150px;
            top: -50px;
            left: -50px;
            animation-delay: 0.5s;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            bottom: -80px;
            right: -80px;
            animation-delay: 1s;
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .brand-logo img {
            height: 150px;
            filter: drop-shadow(0 2px 4px rgba(14, 13, 13, 0.589));
            transition: transform 0.5s ease;
        }

        .brand-logo:hover img {
            transform: scale(1.05) rotate(5deg);
        }

        .rain {
            pointer-events: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 0;
        }

        .rain-drop {
            position: absolute;
            width: 2px;
            height: 22px;
            background: linear-gradient(to bottom, rgba(255,255,255,0.18) 0%, rgba(255,255,255,0.45) 100%);
            border-radius: 1px;
            opacity: 0.7;
            animation: rain-fall 1.3s cubic-bezier(0.4,0.2,0.2,1) infinite;
        }

        @keyframes rain-fall {
            0% { transform: translateY(-40px); opacity: 0.7; }
            80% { opacity: 0.7; }
            100% { transform: translateY(100vh); opacity: 0; }
        }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            100% { transform: translateY(-20px) rotate(5deg); }
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
            backdrop-filter: blur(5px);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
            100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
        }

        .test-credentials {
            margin-top: 2rem;
            background: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            border-radius: 10px;
            color: #fff;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .test-credentials:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-3px);
        }

        .test-credentials h5 {
            color: var(--light-blue);
            margin-bottom: 0.5rem;
            font-size: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding-bottom: 0.5rem;
        }

        .test-credentials ul {
            padding-left: 1.2rem;
            margin-bottom: 0;
        }

        .test-credentials li {
            margin-bottom: 0.3rem;
            transition: all 0.3s ease;
        }

        .test-credentials li:hover {
            color: var(--light-blue);
            transform: translateX(5px);
        }

        @keyframes inputFocus {
            0% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
            100% { transform: translateY(0); }
        }

        .form-floating .form-control:focus {
            animation: inputFocus 0.5s ease;
        }

        .btn-login:after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        .btn-login:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        @keyframes ripple {
            0% { transform: scale(0, 0); opacity: 0.5; }
            100% { transform: scale(20, 20); opacity: 0; }
        }

        ::placeholder {
            color: rgba(255, 255, 255, 0.5) !important;
            opacity: 1 !important;
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
    </div>

    <div class="rain"></div>

    <div class="login-container animate__animated animate__fadeIn">
        <div class="brand-logo">
            <img src="{{ asset('images/logo.png' ) }}" alt="School Logo">
        </div>

        <div style="display: flex; justify-content: center; align-items: center; width: 100%;">
            <h2 class="login-title">Guru Login</h2>
        </div>

        @if(session('error'))
            <div class="alert alert-danger animate__animated animate__shakeX mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('guru.login') }}" method="POST">
            @csrf
            <!-- Username Field with Floating Label and Icon -->
            <div class="form-floating mb-4">
                <span class="input-icon"><i class="fas fa-user"></i></span>
                <input type="text" name="username" class="form-control" id="username"
                       placeholder="Username" required autofocus value="{{ old('username') }}">
                <label for="username">Username</label>
            </div>

            <!-- Password Field with Floating Label and Icon -->
            <div class="form-floating mb-4">
                <span class="input-icon"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" class="form-control" id="password"
                       placeholder="Password" required>
                <label for="password">Password</label>
            </div>

            <button type="submit" class="btn btn-primary btn-login w-100">
                <span class="animate__animated animate__fadeIn">Login</span>
            </button>
        </form>

        <!-- Test Credentials Section -->
        <div class="test-credentials animate__animated animate__fadeIn animate__delay-1s">
            <h5>Test Credentials:</h5>
            <ul>
                <li>Username: <strong>admin123</strong></li>
                <li>Username: <strong>user_With@girim</strong></li>
                <li>Username: <strong>tryp_002</strong></li>
                <li>Password: <strong>mudlar</strong></li>
                <li>Email: <strong>guardib12776@gmail.com</strong></li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add input focus animations
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('animate__animated', 'animate__pulse');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('animate__animated', 'animate__pulse');
                });
            });

            // Rain effect
            function createRain() {
                const rain = document.querySelector('.rain');
                if (!rain) return;

                rain.innerHTML = '';
                const drops = 90;
                const viewportHeight = window.innerHeight;

                for (let i = 0; i < drops; i++) {
                    const drop = document.createElement('div');
                    drop.className = 'rain-drop';
                    drop.style.left = Math.random() * 100 + 'vw';
                    drop.style.top = (-Math.random() * viewportHeight * 0.2) + 'px';
                    drop.style.animationDelay = (Math.random() * 1.2) + 's';
                    drop.style.animationDuration = (1 + Math.random() * 0.7) + 's';
                    rain.appendChild(drop);
                }
            }

            createRain();
            window.addEventListener('resize', createRain);

            // Add animation to form elements when page loads
            setTimeout(() => {
                const formGroups = document.querySelectorAll('.form-floating');
                formGroups.forEach((group, index) => {
                    setTimeout(() => {
                        group.classList.add('animate__animated', 'animate__fadeInUp');
                    }, index * 200);
                });

                const loginBtn = document.querySelector('.btn-login');
                if (loginBtn) {
                    setTimeout(() => {
                        loginBtn.classList.add('animate__animated', 'animate__fadeIn');
                    }, 600);
                }
            }, 300);

            // Add ripple effect to button
            const buttons = document.querySelectorAll('.btn-login');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    this.classList.add('animate__animated', 'animate__pulse');

                    // Remove animation after it completes
                    setTimeout(() => {
                        this.classList.remove('animate__animated', 'animate__pulse');
                    }, 1000);

                    // Submit form after animation
                    setTimeout(() => {
                        this.closest('form').submit();
                    }, 500);
                });
            });

            // Hover effect for input icons
            const inputIcons = document.querySelectorAll('.input-icon');
            inputIcons.forEach(icon => {
                icon.addEventListener('mouseenter', function() {
                    this.classList.add('animate__animated', 'animate__swing');
                });

                icon.addEventListener('animationend', function() {
                    this.classList.remove('animate__animated', 'animate__swing');
                });
            });

            // Fix for autofill background
            function checkInputsForAutofill() {
                inputs.forEach(input => {
                    if (input.matches(':-webkit-autofill')) {
                        input.style.background = 'rgba(255, 255, 255, 0.15) !important';
                        input.style.color = 'white !important';
                        input.style.webkitTextFillColor = 'white !important';
                        input.style.border = '1px solid rgba(255, 255, 255, 0.3) !important';
                    }
                });
            }

            checkInputsForAutofill();
            setTimeout(checkInputsForAutofill, 500);
            setInterval(checkInputsForAutofill, 1000);
        });
    </script>
</body>
</html>
