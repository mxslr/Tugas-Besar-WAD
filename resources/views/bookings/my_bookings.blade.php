{{-- resources/views/bookings/my_bookings.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-bold text-dark mb-0">
            {{ __('Riwayat Booking Saya') }} 🗓️
        </h2>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($bookings->isEmpty())
                <div class="alert alert-info text-center">
                    <p class="mb-0">Anda belum memiliki riwayat booking.</p>
                    <a href="{{ route('bookings.create') }}" class="btn btn-primary mt-3">
                        <i class="bi bi-plus-circle me-1"></i> Buat Booking Baru
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Ruangan</th>
                                <th>Keperluan</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $index => $booking)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $booking->room->room_name }}</strong><br>
                                        <small class="text-muted">{{ $booking->room->building }} - Lt. {{ $booking->room->floor }}</small>
                                    </td>
                                    <td>{{ $booking->subject }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</td>
                                    <td>
                                        @switch($booking->status)
                                            @case('pending')
                                                <span class="badge bg-warning text-dark">Menunggu Persetujuan</span>
                                                @break
                                            @case('approved')
                                                <span class="badge bg-success">Disetujui</span>
                                                @break
                                            @case('rejected')
                                                <span class="badge bg-danger">Ditolak</span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge bg-secondary">Dibatalkan</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td class="text-center">
                                        @if($booking->status === 'pending')
                                            <form action="{{ route('bookings.cancel', $booking->booking_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?');" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="bi bi-x-circle me-1"></i> Batalkan
                                                </button>
                                            </form>
                                        @elseif($booking->status === 'rejected')
                                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#reasonModal{{ $booking->booking_id }}">
                                                <i class="bi bi-info-circle me-1"></i> Lihat Alasan
                                            </button>

                                            {{-- Modal Alasan Penolakan --}}
                                            <div class="modal fade" id="reasonModal{{ $booking->booking_id }}" tabindex="-1" aria-labelledby="reasonModalLabel{{ $booking->booking_id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="reasonModalLabel{{ $booking->booking_id }}">Alasan Penolakan Booking</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            <p>Booking Anda untuk ruangan <strong>{{ $booking->room->room_name }}</strong> pada tanggal <strong>{{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }}</strong> ditolak dengan alasan:</p>
                                                            <div class="bg-light p-3 rounded border fst-italic">
                                                                "{{ $booking->rejection_reason ?? 'Tidak ada alasan spesifik.' }}"
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination (jika digunakan) --}}
                {{-- <div class="mt-3">
                    {{ $bookings->links() }}
                </div> --}}
            @endif
        </div>
    </div>
</x-app-layout>
