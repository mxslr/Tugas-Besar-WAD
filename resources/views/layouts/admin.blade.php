<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Sistem Booking Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #800000 !important; /* warna merah maroon */
        }

        .navbar-brand,
        .navbar-brand span,
        .navbar-nav .nav-link,
        .text-navbar {
            color: #fff !important;
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .card {
            border-radius: 16px;
        }

        .nav-link.active {
            font-weight: bold;
            text-decoration: underline;
        }

        .btn-maroon {
            background-color: #800000;
            color: #fff;
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="/path/logo-telkom.png" alt="Logo">
                <span class="fw-semibold">Admin Booking Ruangan</span>
            </a>
            <div>
                <span class="me-3 text-navbar">{{ Auth::user()->username }}</span>
                <a class="btn btn-light btn-sm" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
