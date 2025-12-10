<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\HomeController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

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