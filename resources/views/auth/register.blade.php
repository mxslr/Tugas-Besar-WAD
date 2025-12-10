<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Booking Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Figtree', sans-serif;
        }
        .register-card {
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
        <div class="card shadow border-0 register-card">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <img src="/path/logo-telkom.png" alt="Logo Telkom University" style="height: 60px;">
                    <h4 class="mt-3 text-maroon fw-bold">Registrasi Akun</h4>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input id="username" class="form-control mt-1" type="text" name="username" value="{{ old('username') }}" required autofocus autocomplete="username" />
                        @error('username')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control mt-1" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" />
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" class="form-control mt-1" type="password" name="password" required autocomplete="new-password" />
                        @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input id="password_confirmation" class="form-control mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
                        @error('password_confirmation')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-maroon w-100 py-2 fw-semibold shadow-sm" style="border-radius: 8px;">
                        Daftar
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <span class="text-secondary">Sudah punya akun?</span>
                    <a href="{{ route('login') }}" class="text-maroon text-decoration-none fw-semibold ms-1">
                        Login di sini
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>