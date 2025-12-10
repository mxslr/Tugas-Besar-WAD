@extends('layouts.admin')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold text-maroon">Dashboard Admin</h2>
        <p class="text-muted">Selamat datang, <strong>{{ Auth::user()->username }}</strong>! Anda login sebagai Administrator.</p>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-maroon fw-semibold">Manajemen Ruangan</h5>
                    <p class="card-text">Kelola data ruangan, fasilitas, dan ketersediaan.</p>
                    <a href="{{ route('admin.rooms.index') }}" class="btn btn-maroon">Buka Manajemen Ruangan</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-maroon fw-semibold">Approval Booking</h5>
                    <p class="card-text">Lihat, setujui, atau tolak permintaan booking ruangan.</p>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-success">Buka Approval Booking</a>
                </div>
            </div>
        </div>

        {{-- Tambahkan card tambahan di sini bila perlu --}}
    </div>
@endsection
