<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu - TravelTour</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
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

        .login-link {
            color: #1e88e5;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .login-link:hover {
            color: #1976d2;
            text-decoration: underline;
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
                    <p class="text-muted">Quên mật khẩu? Nhập email để nhận liên kết đặt lại mật khẩu.</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success text-center">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-floating">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                        <label for="email"><i class="bi bi-envelope-fill me-1"></i>Địa chỉ email</label>
                        @error('email')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button class="w-100 btn btn-lg btn-travel" type="submit">
                        <i class="bi bi-envelope-arrow-up me-2"></i>Gửi liên kết đặt lại mật khẩu
                    </button>

                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="login-link">
                            Quay lại đăng nhập
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>