<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Booking Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Figtree', sans-serif;
        }
        .login-card {
            max-width: 400px;
            border-radius: 18px;
        }
        .btn-maroon {
            background-color: #800000;
            color: white;
            border: none;
        }
        .btn-maroon:hover {
            background-color: #a00000;
        }
        .text-maroon {
            color: #800000;
        }
    </style>
</head>
<body>
    <div class="min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card shadow border-0 login-card">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <img src="/path/logo-telkom.png" alt="Logo Telkom University" style="height: 60px;">
                    <h4 class="mt-3 text-maroon fw-bold">Sistem Booking Ruangan</h4>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success mb-3">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control mt-1" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" class="form-control mt-1" type="password" name="password" required autocomplete="current-password" />
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" onclick="togglePassword('password', this)">
                            <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
                        </span>
                        @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-decoration-none text-secondary" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif

                        <button type="submit" class="btn btn-maroon ms-auto px-4 py-2 fw-semibold shadow-sm" style="border-radius: 8px;">
                            Log in
                        </button>
                    </div>
                </form>

                <div class="mt-4 text-center">
                    <span class="text-secondary">Belum punya akun?</span>
                    <a href="{{ route('register') }}" class="text-maroon text-decoration-none fw-semibold ms-1">
                        Daftar di sini
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
