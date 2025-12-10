<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Dashboard Pengguna') }}
        </h2>
    </x-slot>

    {{-- Welcome Card --}}
    <div class="card shadow border-0 mb-4 text-white" style="background-color: #800000;">
        <div class="card-body d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-2">Selamat Datang, {{ Auth::user()->username }}!</h5>
                <p class="mb-0">Anda login sebagai <strong class="text-warning">{{ ucfirst(Auth::user()->role) }}</strong>.</p>
            </div>
            <i class="bi bi-person-circle" style="font-size: 3rem;"></i>
        </div>
    </div>

    {{-- Quick Action Cards --}}
    <div class="row">
        <div class="col-md-4 mb-3">
            <a href="{{ route('bookings.create') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100 hover-card">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-calendar-plus fs-2 text-maroon me-3"></i>
                        <div>
                            <h6 class="mb-1 text-dark">Buat Booking</h6>
                            <p class="mb-0 text-secondary small">Pesan ruangan baru dengan cepat</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="{{ route('bookings.my') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100 hover-card">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-clock-history fs-2 text-maroon me-3"></i>
                        <div>
                            <h6 class="mb-1 text-dark">Riwayat Booking</h6>
                            <p class="mb-0 text-secondary small">Lihat daftar booking Anda sebelumnya</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="{{ route('profile.edit') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100 hover-card">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-person-gear fs-2 text-maroon me-3"></i>
                        <div>
                            <h6 class="mb-1 text-dark">Edit Profil</h6>
                            <p class="mb-0 text-secondary small">Kelola data diri Anda</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- Style --}}
    <style>
        .text-maroon {
            color: #800000;
        }

        .hover-card:hover {
            transform: scale(1.02);
            transition: 0.2s ease;
            border-left: 5px solid #800000;
            cursor: pointer;
        }

        .card h6 {
            font-weight: 600;
        }

        .card-body i {
            min-width: 40px;
        }
    </style>
</x-app-layout>
