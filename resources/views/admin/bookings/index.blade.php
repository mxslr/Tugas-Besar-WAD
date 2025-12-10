{{-- resources/views/admin/bookings/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold text-dark">
            {{ __('Approval Booking Ruangan') }}
        </h2>
    </x-slot>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.bookings.index') }}">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="status_filter" class="col-form-label">Filter Status:</label>
                    </div>
                    <div class="col-auto">
                        <select name="status" id="status_filter" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-outline-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($bookings->isEmpty())
                <div class="alert alert-info">Tidak ada data booking yang cocok dengan filter saat ini.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Pemesan</th>
                                <th>Ruangan</th>
                                <th>Keperluan</th>
                                <th>Tanggal & Waktu</th>
                                <th>Peserta</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->booking_id }}</td>
                                    <td>
                                        {{ $booking->user->username }}
                                        <br><small class="text-muted">{{ $booking->user->email }}</small>
                                    </td>
                                    <td>{{ $booking->room->room_name }}</td>
                                    <td>{{ $booking->subject }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }} <br>
                                        {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
                                    </td>
                                    <td>{{ $booking->participants }}</td>
                                    <td>
                                        @if($booking->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($booking->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($booking->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @elseif($booking->status == 'cancelled')
                                            <span class="badge bg-secondary">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->status == 'pending')
                                            <button type="button" class="btn btn-sm btn-success mb-1" data-bs-toggle="modal" data-bs-target="#approveModal{{ $booking->booking_id }}">
                                                Setujui
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $booking->booking_id }}">
                                                Tolak
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-info mb-1" data-bs-toggle="modal" data-bs-target="#detailModal{{ $booking->booking_id }}">
                                                Detail
                                            </button>
                                        @endif

                                        {{-- Modal Detail --}}
                                        <div class="modal fade" id="detailModal{{ $booking->booking_id }}" tabindex="-1">
                                          <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title">Detail Booking #{{ $booking->booking_id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                              </div>
                                              <div class="modal-body">
                                                <p><strong>Pemesan:</strong> {{ $booking->user->username }} ({{ $booking->user->role }})</p>
                                                <p><strong>Ruangan:</strong> {{ $booking->room->room_name }} (Kode: {{ $booking->room->room_code }})</p>
                                                <p><strong>Kapasitas Ruangan:</strong> {{ $booking->room->capacity }}</p>
                                                <p><strong>Keperluan:</strong> {{ $booking->subject }}</p>
                                                @if($booking->lecturer_name)
                                                <p><strong>Nama Dosen:</strong> {{ $booking->lecturer_name }}</p>
                                                @endif
                                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y') }}</p>
                                                <p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</p>
                                                <p><strong>Jumlah Peserta:</strong> {{ $booking->participants }}</p>
                                                <p><strong>Tujuan:</strong> {!! nl2br(e($booking->purpose)) !!}</p>
                                                <hr>
                                                <p><strong>Status Saat Ini:</strong> <span class="fw-bold">{{ ucfirst($booking->status) }}</span></p>
                                                @if($booking->approver)
                                                    <p><strong>{{ ucfirst($booking->status) == 'Approved' ? 'Disetujui' : 'Ditolak' }} oleh:</strong> {{ $booking->approver->username }} pada {{ \Carbon\Carbon::parse($booking->approved_at)->translatedFormat('d M Y H:i') }}</p>
                                                    @if($booking->status == 'rejected')
                                                        <p><strong>Alasan Penolakan:</strong> {{ $booking->rejection_reason ?? '-' }}</p>
                                                    @endif
                                                @endif
                                                <p><strong>Diajukan pada:</strong> {{ $booking->created_at->translatedFormat('d M Y H:i') }}</p>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        {{-- Modal Approve --}}
                                        <div class="modal fade" id="approveModal{{ $booking->booking_id }}" tabindex="-1">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Persetujuan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                              </div>
                                              <div class="modal-body">
                                                Apakah Anda yakin ingin menyetujui booking untuk ruangan <strong>{{ $booking->room->room_name }}</strong> oleh <strong>{{ $booking->user->username }}</strong>?
                                              </div>
                                              <div class="modal-footer">
                                                <form action="{{ route('admin.bookings.approve', $booking->booking_id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success">Ya, Setujui</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        {{-- Modal Reject --}}
                                        <div class="modal fade" id="rejectModal{{ $booking->booking_id }}" tabindex="-1">
                                          <div class="modal-dialog">
                                            <form action="{{ route('admin.bookings.reject', $booking->booking_id) }}" method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Penolakan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>Anda akan menolak booking untuk ruangan <strong>{{ $booking->room->room_name }}</strong> oleh <strong>{{ $booking->user->username }}</strong>.</p>
                                                    <div class="mb-3">
                                                        <label for="rejection_reason{{ $booking->booking_id }}" class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                                                        <textarea name="rejection_reason" id="rejection_reason{{ $booking->booking_id }}" class="form-control" rows="3" required></textarea>
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">Ya, Tolak</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                  </div>
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $bookings->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
