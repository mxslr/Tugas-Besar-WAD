<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-bold text-dark mb-0">
            {{ __('Buat Booking Ruangan Baru') }} 📝
        </h2>
    </x-slot>

    <div class="card shadow border-0">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('bookings.store') }}">
                @csrf

                {{-- Pilih Ruangan --}}
                <div class="mb-4">
                    <label for="room_id" class="form-label fw-semibold text-maroon">Pilih Ruangan <span class="text-danger">*</span></label>
                    <select name="room_id" id="room_id" class="form-select soft-input @error('room_id') is-invalid @enderror" required>
                        <option value="" disabled {{ old('room_id') ? '' : 'selected' }}>-- Pilih Ruangan --</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->room_id }}" {{ old('room_id') == $room->room_id ? 'selected' : '' }}>
                                {{ $room->room_name }} ({{ $room->building }} - Lt. {{ $room->floor }}) - Kapasitas: {{ $room->capacity }} org
                            </option>
                        @endforeach
                    </select>
                    @error('room_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Keperluan --}}
                <div class="mb-4">
                    <label for="subject" class="form-label fw-semibold text-maroon">Keperluan / Mata Kuliah <span class="text-danger">*</span></label>
                    <input type="text" name="subject" id="subject" class="form-control soft-input @error('subject') is-invalid @enderror" value="{{ old('subject') }}" required>
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nama Dosen --}}
                <div class="mb-4">
                    <label for="lecturer_name" class="form-label fw-semibold text-maroon">Nama Dosen Pengampu (jika ada)</label>
                    <input type="text" name="lecturer_name" id="lecturer_name" class="form-control soft-input @error('lecturer_name') is-invalid @enderror" value="{{ old('lecturer_name') }}">
                    @error('lecturer_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="booking_date" class="form-label fw-semibold text-maroon">Tanggal Booking <span class="text-danger">*</span></label>
                        <input type="date" name="booking_date" id="booking_date" class="form-control soft-input @error('booking_date') is-invalid @enderror" value="{{ old('booking_date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                        @error('booking_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="start_time" class="form-label fw-semibold text-maroon">Waktu Mulai <span class="text-danger">*</span></label>
                        <input type="time" name="start_time" id="start_time" class="form-control soft-input @error('start_time') is-invalid @enderror" value="{{ old('start_time') }}" required>
                        @error('start_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="end_time" class="form-label fw-semibold text-maroon">Waktu Selesai <span class="text-danger">*</span></label>
                        <input type="time" name="end_time" id="end_time" class="form-control soft-input @error('end_time') is-invalid @enderror" value="{{ old('end_time') }}" required>
                        @error('end_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Jumlah Peserta --}}
                <div class="mb-4">
                    <label for="participants" class="form-label fw-semibold text-maroon">Jumlah Peserta <span class="text-danger">*</span></label>
                    <input type="number" name="participants" id="participants" class="form-control soft-input @error('participants') is-invalid @enderror" value="{{ old('participants') }}" min="1" required>
                    @error('participants')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tujuan --}}
                <div class="mb-4">
                    <label for="purpose" class="form-label fw-semibold text-maroon">Tujuan Penggunaan Ruangan <span class="text-danger">*</span></label>
                    <textarea name="purpose" id="purpose" class="form-control soft-input @error('purpose') is-invalid @enderror" rows="4" required>{{ old('purpose') }}</textarea>
                    @error('purpose')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Error khusus --}}
                @if ($errors->has('jadwal_konflik'))
                    <div class="alert alert-danger">{{ $errors->first('jadwal_konflik') }}</div>
                @endif
                @if ($errors->has('kapasitas'))
                    <div class="alert alert-danger">{{ $errors->first('kapasitas') }}</div>
                @endif

                {{-- Tombol Submit --}}
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-maroon px-4 py-2 shadow-sm">
                        <i class="bi bi-calendar-plus-fill me-2"></i> Ajukan Booking
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Custom CSS --}}
    <style>
        .text-maroon {
            color: #800000;
        }

        .btn-maroon {
            background-color: #800000;
            color: #fff;
            border: none;
        }

        .btn-maroon:hover {
            background-color: #660000;
        }

        .soft-input {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            transition: 0.2s ease-in-out;
        }

        .soft-input:focus {
            border-color: #800000;
            box-shadow: 0 0 0 0.15rem rgba(128, 0, 0, 0.25);
        }

        .form-label {
            color: #333;
        }
    </style>
</x-app-layout>
