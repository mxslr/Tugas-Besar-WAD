{{-- resources/views/admin/rooms/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-bold text-maroon">
            {{ __('Tambah Ruangan Baru') }}
        </h2>
    </x-slot>

    <div class="card shadow border-0 rounded-4 mt-4">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.rooms.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="room_code" class="form-label fw-semibold">Kode Ruangan <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            name="room_code" 
                            id="room_code" 
                            class="form-control @error('room_code') is-invalid @enderror" 
                            value="{{ old('room_code') }}" 
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
                            value="{{ old('room_name') }}" 
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
                            value="{{ old('building') }}" 
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
                            value="{{ old('floor') }}" 
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
                            value="{{ old('capacity') }}" 
                            min="1"
                            required
                            placeholder="Contoh: 50"
                        >
                        @error('capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3">
                    <label for="facilities_text" class="form-label fw-semibold">Fasilitas <small class="text-muted">(format JSON, contoh: ["Proyektor", "AC"])</small></label>
                    <input 
                        type="text" 
                        name="facilities_text" 
                        id="facilities_text" 
                        class="form-control @error('facilities') is-invalid @enderror" 
                        value="{{ old('facilities_text') }}" 
                        placeholder="{{ old('facilities_text') }}"
                        
                    >
                    
                    @error('facilities')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-3">
                    <label for="description" class="form-label fw-semibold">Deskripsi Tambahan</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        class="form-control @error('description') is-invalid @enderror" 
                        rows="3" 
                        placeholder="Masukkan deskripsi tambahan jika ada..."
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-3">
                    <label for="status" class="form-label fw-semibold">Status Awal <span class="text-danger">*</span></label>
                    <select 
                        name="status" 
                        id="status" 
                        class="form-select @error('status') is-invalid @enderror" 
                        required
                    >
                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                        <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Tidak Tersedia</option>
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
                        <i class="bi bi-save2 me-2"></i> Simpan Ruangan
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

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const facilitiesText = document.getElementById('facilities_text').value;
            if (facilitiesText.trim() !== '') {
                try {
                    JSON.parse(facilitiesText); // Validasi JSON
                } catch (error) {
                    alert('Format JSON untuk fasilitas tidak valid.');
                    e.preventDefault();
                }
            }
        });
    </script>
</x-app-layout>
