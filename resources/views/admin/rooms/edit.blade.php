{{-- resources/views/admin/rooms/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-bold text-maroon">
            {{ __('Edit Ruangan: ') }} <span class="text-primary">{{ $room->room_name }}</span>
        </h2>
    </x-slot>

    <div class="card shadow border-0 rounded-4 mt-4">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.rooms.update', $room->room_id) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="room_code" class="form-label fw-semibold">Kode Ruangan <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            name="room_code" 
                            id="room_code" 
                            class="form-control @error('room_code') is-invalid @enderror" 
                            value="{{ old('room_code', $room->room_code) }}" 
                            required 
                            autofocus
                            placeholder="Contoh: RM101"
                        >
                        @error('room_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="room_name" class="form-label fw-semibold">Nama Ruangan <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            name="room_name" 
                            id="room_name" 
                            class="form-control @error('room_name') is-invalid @enderror" 
                            value="{{ old('room_name', $room->room_name) }}" 
                            required
                            placeholder="Contoh: Ruang Rapat 1"
                        >
                        @error('room_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-4">
                        <label for="building" class="form-label fw-semibold">Nama Gedung <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            name="building" 
                            id="building" 
                            class="form-control @error('building') is-invalid @enderror" 
                            value="{{ old('building', $room->building) }}" 
                            required
                            placeholder="Contoh: Gedung A"
                        >
                        @error('building')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="floor" class="form-label fw-semibold">Lantai <span class="text-danger">*</span></label>
                        <input 
                            type="number" 
                            name="floor" 
                            id="floor" 
                            class="form-control @error('floor') is-invalid @enderror" 
                            value="{{ old('floor', $room->floor) }}" 
                            required
                            min="0"
                            placeholder="Contoh: 1"
                        >
                        @error('floor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="capacity" class="form-label fw-semibold">Kapasitas <span class="text-danger">*</span></label>
                        <input 
                            type="number" 
                            name="capacity" 
                            id="capacity" 
                            class="form-control @error('capacity') is-invalid @enderror" 
                            value="{{ old('capacity', $room->capacity) }}" 
                            required
                            min="1"
                            placeholder="Contoh: 50"
                        >
                        @error('capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3">
                    <label for="facilities_text" class="form-label fw-semibold">
                        <i class="bi bi-tools text-primary me-1"></i> Fasilitas 
                        <small class="text-muted">(format JSON, contoh: ["Proyektor", "AC"])</small>
                    </label>
                    <input 
                        type="text" 
                        name="facilities_text" 
                        id="facilities_text" 
                        class="form-control @error('facilities') is-invalid @enderror" 
                        value="{{ old('facilities_text', is_array($room->facilities) ? json_encode($room->facilities) : $room->facilities) }}" 
                        placeholder='["Proyektor", "AC", "Papan Tulis"]'
                        style="font-family: monospace;"
                        required
                    >
                    <div id="facilities-error" class="invalid-feedback d-none"></div>
                    @error('facilities')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted fst-italic mt-1">
                        Masukkan daftar fasilitas dalam format JSON array, misalnya: <code>["Proyektor", "AC", "Papan Tulis"]</code>
                    </small>
                </div>

                <div class="mt-3">
                    <label for="description" class="form-label fw-semibold">Deskripsi Tambahan</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        class="form-control @error('description') is-invalid @enderror" 
                        rows="3" 
                        placeholder="Masukkan deskripsi tambahan jika ada..."
                    >{{ old('description', $room->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-3">
                    <label for="status" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select 
                        name="status" 
                        id="status" 
                        class="form-select @error('status') is-invalid @enderror" 
                        required
                    >
                        <option value="available" {{ old('status', $room->status) == 'available' ? 'selected' : '' }}>Tersedia</option>
                        <option value="maintenance" {{ old('status', $room->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        <option value="unavailable" {{ old('status', $room->status) == 'unavailable' ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-secondary fw-semibold px-4">
                        <i class="bi bi-x-circle me-2"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-maroon fw-semibold px-4">
                        <i class="bi bi-save2 me-2"></i> Update Ruangan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
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
    </style>

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Script validasi JSON untuk fasilitas --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const facilitiesInput = document.getElementById('facilities_text');
        const errorDiv = document.getElementById('facilities-error');

        form.addEventListener('submit', function (e) {
            let facilitiesValue = facilitiesInput.value.trim();

            if (facilitiesValue !== '') {
                try {
                    let parsed = JSON.parse(facilitiesValue);
                    if (!Array.isArray(parsed)) {
                        throw new Error('Format harus berupa array JSON.');
                    }
                    // Clear error if valid
                    errorDiv.classList.add('d-none');
                    facilitiesInput.classList.remove('is-invalid');
                } catch (error) {
                    e.preventDefault(); // stop submit
                    errorDiv.textContent = 'Format JSON tidak valid atau bukan array: ' + error.message;
                    errorDiv.classList.remove('d-none');
                    facilitiesInput.classList.add('is-invalid');
                    facilitiesInput.focus();
                }
            } else {
                // Empty value is allowed, clear errors
                errorDiv.classList.add('d-none');
                facilitiesInput.classList.remove('is-invalid');
            }
        });
    });
    </script>

</x-app-layout>
