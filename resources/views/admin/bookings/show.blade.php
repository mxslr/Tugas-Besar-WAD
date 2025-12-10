<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold text-dark">
            {{ __('Detail Booking #') }}{{ $booking->booking_id }}
        </h2>
    </x-slot>

    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center bg-white">
            <span class="fw-semibold">Status:</span>
            <span class="badge fs-6
                @if($booking->status == 'pending') bg-warning text-dark
                @elseif($booking->status == 'approved') bg-success
                @elseif($booking->status == 'rejected') bg-danger
                @elseif($booking->status == 'cancelled') bg-secondary
                @endif">
                {{ ucfirst($booking->status) }}
            </span>
        </div>
        <div class="card-body">
            <div class="row gy-4">
                {{-- Informasi Pemesan --}}
                <div class="col-md-6">
                    <h5 class="fw-bold mb-3">Informasi Pemesan</h5>
                    <ul class="list-unstyled">
                        <li><strong>Nama:</strong> {{ $booking->user->username }}</li>
                        <li><strong>Email:</strong> {{ $booking->user->email }}</li>
                        <li><strong>Role:</strong> {{ ucfirst($booking->user->role) }}</li>
                    </ul>
                </div>

                {{-- Informasi Ruangan --}}
                <div class="col-md-6">
                    <h5 class="fw-bold mb-3">Informasi Ruangan</h5>
                    <ul class="list-unstyled">
                        <li><strong>Nama Ruangan:</strong> {{ $booking->room->room_name }} ({{ $booking->room->room_code }})</li>
                        <li><strong>Gedung:</strong> {{ $booking->room->building }}, Lantai {{ $booking->room->floor }}</li>
                        <li><strong>Kapasitas:</strong> {{ $booking->room->capacity }} orang</li>
                        <li><strong>Fasilitas:</strong>
                            {{ is_array($booking->room->facilities) ? implode(', ', $booking->room->facilities) : ($booking->room->facilities ?? '-') }}
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="my-4">

            {{-- Detail Booking --}}
            <h5 class="fw-bold mb-3">Detail Permintaan</h5>
            <ul class="list-unstyled">
                <li><strong>Keperluan / Mata Kuliah:</strong> {{ $booking->subject }}</li>
                @if($booking->lecturer_name)
                    <li><strong>Nama Dosen Pengampu:</strong> {{ $booking->lecturer_name }}</li>
                @endif
                <li><strong>Tanggal Booking:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y') }}</li>
                <li><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</li>
                <li><strong>Jumlah Peserta:</strong> {{ $booking->participants }}</li>
                <li><strong>Tujuan Penggunaan:</strong>
                    <div class="p-3 bg-light border rounded mt-2">
                        {!! nl2br(e($booking->purpose)) !!}
                    </div>
                </li>
            </ul>

            <hr class="my-4">

            {{-- Riwayat --}}
            <p><strong>Diajukan pada:</strong> {{ $booking->created_at->translatedFormat('d F Y, H:i:s') }}</p>
            @if(in_array($booking->status, ['approved', 'rejected']))
                <p><strong>Diproses oleh Admin:</strong> {{ $booking->approver->username ?? 'N/A' }}</p>
                <p><strong>Waktu Proses:</strong> {{ $booking->approved_at ? \Carbon\Carbon::parse($booking->approved_at)->translatedFormat('d F Y, H:i:s') : 'N/A' }}</p>
                @if($booking->status == 'rejected')
                    <p><strong>Alasan Penolakan:</strong> {{ $booking->rejection_reason ?? '-' }}</p>
                @endif
            @endif
        </div>

        {{-- Tombol Aksi --}}
        <div class="card-footer text-end bg-white">
            @if($booking->status == 'pending')
                <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#approveModal{{ $booking->booking_id }}">
                    <i class="bi bi-check-circle"></i> Setujui
                </button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $booking->booking_id }}">
                    <i class="bi bi-x-circle"></i> Tolak
                </button>
            @endif
            <a href="{{ route('admin.bookings.index', ['status' => $booking->status]) }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </div>

    {{-- Modal Approve & Reject (include di sini) --}}
    @include('admin.bookings.partials.modal_action', ['booking' => $booking])

    <style>
        .card {
            border-radius: 18px;
            box-shadow: 0 2px 16px 0 rgba(128,0,0,0.08);
        }
        .card-header, .card-footer {
            border-radius: 18px 18px 0 0;
            background: #f8f9fa;
        }
        .card-footer {
            border-radius: 0 0 18px 18px;
        }
        .fw-bold, .fw-semibold {
            color: #800000;
        }
        .badge {
            font-size: 1rem;
            padding: 0.5em 1em;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn-success, .btn-danger, .btn-secondary {
            border-radius: 8px;
            font-weight: 500;
            transition: 0.2s;
        }
        .btn-success:hover, .btn-danger:hover, .btn-secondary:hover {
            filter: brightness(0.95);
            transform: scale(1.03);
        }
        .section-title {
            color: #800000;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .bg-section {
            background: #f3f3f3;
            border-radius: 10px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }
        .list-unstyled li {
            margin-bottom: 0.5rem;
        }
        .bg-light.border.rounded {
            background: #f8f9fa !important;
            border: 1px solid #e0e0e0 !important;
            border-radius: 8px !important;
        }
    </style>
</x-app-layout>
