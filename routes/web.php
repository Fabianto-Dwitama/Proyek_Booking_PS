<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PlaystationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MidtransCallbackController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman awal
// Root buka UI pembeli (guest booking)
Route::get('/', function () {
    return redirect('/booking');
});

// Dashboard bawaan Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Profile
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// ADMIN
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');
});


// OWNER
Route::middleware(['auth', 'role:owner'])
    ->prefix('owner')
    ->group(function () {

        Route::get('/dashboard', [OwnerController::class, 'dashboard'])
            ->name('owner.dashboard');

        Route::resource('playstations', PlaystationController::class);
});


// PEMBELI
// Public booking routes (guest booking without login)
Route::get('/booking', [BookingController::class, 'createGuest'])
    ->name('booking.guest.create');

Route::post('/booking', [BookingController::class, 'storeGuest'])
    ->name('booking.guest.store');

// End public booking routes

Route::middleware(['auth', 'role:pembeli'])
    ->prefix('pembeli')
    ->group(function () {

        Route::get('/dashboard', [PembeliController::class, 'dashboard'])
            ->name('pembeli.dashboard');

        Route::resource('bookings', BookingController::class);

        Route::resource('payments', PaymentController::class);
});

Route::post(
    '/midtrans/callback',
    [MidtransCallbackController::class, 'handle']
);

require __DIR__.'/auth.php';