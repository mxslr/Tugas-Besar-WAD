<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\HomeController;
// Tambahan untuk Admin Darurat
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// --- FITUR ADMIN DARURAT (REVISI SESUAI DB KAMU) ---
Route::get('/buat-admin-darurat', function () {
    try {
        // 1. Cek apakah user sudah ada
        $cek = User::where('email', 'superadmin@test.com')->first();
        if ($cek) {
            return "User admin sudah ada! Silakan login dengan email: superadmin@test.com";
        }

        // 2. Buat User Baru
        $user = new User();
        
        // HAPUS baris $user->name karena kolom 'name' tidak ada di database kamu
        // $user->name = 'Super Admin'; 
        
        $user->username = 'superadmin';
        $user->email = 'superadmin@test.com';
        $user->role = 'admin'; 
        
        // Perhatikan ini: Berdasarkan error log kamu, kolomnya bernama 'password_hash'
        // Jika nanti error "Unknown column password_hash", ganti jadi $user->password
        $user->password = Hash::make('password123'); 
        
        // Jika User Model kamu memaksa field 'password_hash', uncomment baris bawah ini:
        // $user->password_hash = Hash::make('password123');

        $user->save();

        return "SUKSES! User Admin berhasil dibuat.<br>Email: superadmin@test.com<br>Password: password123";

    } catch (\Exception $e) {
        return "ERROR: " . $e->getMessage();
    }
});
// ---------------------------------------------------

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('bookings')->name('bookings.')->group(function () {
        Route::get('/create', [BookingController::class, 'create'])->name('create');
        Route::post('/', [BookingController::class, 'store'])->name('store');
        Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('my');
        Route::patch('/{booking}/cancel', [BookingController::class, 'cancel'])->name('cancel');
    });

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('rooms', AdminRoomController::class);

        Route::prefix('bookings')->name('bookings.')->group(function () {
            Route::get('/', [AdminBookingController::class, 'index'])->name('index');
            Route::get('/{booking}', [AdminBookingController::class, 'show'])->name('show');
            Route::patch('/{booking}/approve', [AdminBookingController::class, 'approve'])->name('approve');
            Route::post('/{booking}/reject', [AdminBookingController::class, 'reject'])->name('reject');
        });

        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        Route::resource('reports', App\Http\Controllers\Admin\ReportController::class);
    });
});

require __DIR__.'/auth.php';