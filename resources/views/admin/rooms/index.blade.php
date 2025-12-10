{{-- resources/views/admin/rooms/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 fw-bold text-maroon mb-0">
                {{ __('Manajemen Ruangan') }}
            </h2>
            <a href="{{ route('admin.rooms.create') }}" class="btn btn-maroon btn-lg px-4 fw-semibold shadow-sm rounded-3">
                <i class="bi bi-plus-circle me-2"></i> Tambah Ruangan Baru
            </a>
        </div>
    </x-slot>

    <div class="card shadow border-0 mt-4 rounded-4">
        <div class="card-body p-4">
            @if($rooms->isEmpty())
                <div class="alert alert-info text-center py-4 fs-5 rounded-3">
                    <i class="bi bi-info-circle-fill me-2"></i> 
                    Belum ada data ruangan. <a href="{{ route('admin.rooms.create') }}" class="alert-link fw-semibold">Tambah sekarang</a>.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover rounded-3">
                        <thead class="bg-maroon text-white text-uppercase text-center" style="border-radius: 1rem;">
                            <tr>
                                <th class="py-3 px-4 rounded-start">Kode</th>
                                <th class="py-3 px-4 text-start">Nama Ruangan</th>
                                <th class="py-3 px-4">Gedung</th>
                                <th class="py-3 px-4">Lantai</th>
                                <th class="py-3 px-4">Kapasitas</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4 rounded-end text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room)
                                <tr class="align-middle text-center" style="cursor: default;">
                                    <td class="fw-semibold">{{ $room->room_code }}</td>
                                    <td class="text-start">{{ $room->room_name }}</td>
                                    <td>{{ $room->building }}</td>
                                    <td>{{ $room->floor }}</td>
                                    <td>{{ $room->capacity }}</td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                'available' => 'bg-success text-white',
                                                'maintenance' => 'bg-warning text-dark',
                                                'unavailable' => 'bg-danger text-white'
                                            ];
                                        @endphp
                                        <span class="badge px-3 py-2 fs-6 rounded-pill {{ $statusClasses[$room->status] ?? 'bg-secondary' }}">
                                            @if($room->status === 'available') Tersedia
                                            @elseif($room->status === 'maintenance') Maintenance
                                            @elseif($room->status === 'unavailable') Tidak Tersedia
                                            @else {{ ucfirst($room->status) }}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.rooms.edit', $room->room_id) }}" class="btn btn-sm btn-outline-warning px-3 me-2 fw-semibold shadow-sm" data-bs-toggle="tooltip" title="Edit Ruangan">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('admin.rooms.destroy', $room->room_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruangan ini? Booking terkait juga mungkin terpengaruh.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger px-3 fw-semibold shadow-sm" data-bs-toggle="tooltip" title="Hapus Ruangan">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination jika ada --}}
                {{-- <div class="mt-3 d-flex justify-content-end">
                    {{ $rooms->links() }}
                </div> --}}
            @endif
        </div>
    </div>

    <style>
        /* Warna maroon utama */
        .bg-maroon {
            background-color: #800000 !important;
        }
        .text-maroon {
            color: #800000 !important;
        }
        .btn-maroon {
            background-color: #800000;
            color: #fff;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-maroon:hover, .btn-maroon:focus {
            background-color: #a00000;
            color: #fff;
        }
        /* Hover row tabel */
        table.table-hover tbody tr:hover {
            background-color: #f9e6e6;
        }
        /* Rounded untuk thead */
        thead tr th:first-child {
            border-top-left-radius: 1rem;
        }
        thead tr th:last-child {
            border-top-right-radius: 1rem;
        }
        /* Tooltip style */
        [data-bs-toggle="tooltip"] {
            cursor: pointer;
        }
    </style>

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Initialize tooltips --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</x-app-layout>
