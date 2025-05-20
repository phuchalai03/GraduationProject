<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - TravelTour</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <style>
        body {
            background-image: url('assets/images/backgrounds/login.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
            pointer-events: none;
        }

        .form-signin {
            max-width: 450px;
            padding: 15px;
            position: relative;
            z-index: 1;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.25);
            border: none;
            backdrop-filter: blur(5px);
            background-color: rgba(255, 255, 255, 0.9);
        }

        .card-body {
            padding: 2.5rem;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }

        .divider::before {
            margin-right: .5em;
        }

        .divider::after {
            margin-left: .5em;
        }

        .form-floating {
            margin-bottom: 1.25rem;
        }

        .btn-travel {
            background-color: #1e88e5;
            border-color: #1e88e5;
            padding: 0.75rem;
            color: white;
            font-weight: 500;
            box-shadow: 0 4px 6px rgba(30, 136, 229, 0.25);
            transition: all 0.3s ease;
        }

        .btn-travel:hover {
            background-color: #1976d2;
            border-color: #1976d2;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(30, 136, 229, 0.3);
            color: white;
        }

        .logo-text {
            font-family: 'Arial', sans-serif;
            color: #1e88e5;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .logo-icon {
            color: #1e88e5;
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }

        .form-control:focus {
            border-color: #1e88e5;
            box-shadow: 0 0 0 0.25rem rgba(30, 136, 229, 0.25);
        }

        .form-check-input:checked {
            background-color: #1e88e5;
            border-color: #1e88e5;
        }

        .register-link,
        .forgot-link {
            color: #1e88e5;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .register-link:hover,
        .forgot-link:hover {
            color: #1976d2;
            text-decoration: underline;
        }

        .welcome-text {
            color: #444;
        }
    </style>
</head>

<body>
    <main class="form-signin w-100 m-auto">
        <div class="card">
            <div class="card-body">
                <div class="text-center mb-4">
                    <i class="bi bi-airplane logo-icon"></i>
                    <h2 class="logo-text">TRAVELDAY</h2>
                    <p class="text-muted">Khám phá những điểm đến tuyệt vời!!!</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-floating">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="name@example.com" value="{{ old('email') }}" required autofocus
                            autocomplete="username">
                        <label for="email"><i class="bi bi-envelope-fill me-1"></i>Địa chỉ email</label>
                        @error('email')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" placeholder="Password" required
                            autocomplete="current-password">
                        <label for="password"><i class="bi bi-lock-fill me-1"></i>Mật khẩu</label>
                        @error('password')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between mb-4 align-items-center">
                        <div class="form-check text-start">
                            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                            <label class="form-check-label" for="remember_me">
                                Ghi nhớ đăng nhập
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">
                                Quên mật khẩu?
                            </a>
                        @endif
                    </div>

                    <button class="w-100 btn btn-lg btn-travel" type="submit">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập
                    </button>

                    <div class="divider text-muted">
                        hoặc
                    </div>

                    <div class="d-grid gap-2 mb-4">
                        <a href="{{ route('login-google') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-google me-2"></i>Đăng nhập bằng Google
                        </a>
                    </div>

                    @if (Route::has('register'))
                        <div class="text-center mt-3">
                            <p class="mb-0">Chưa có tài khoản?
                                <a href="{{ route('register') }}" class="register-link">
                                    Đăng ký ngay
                                </a>
                            </p>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
