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

    if (auth()->check()) {

        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if (auth()->user()->hasRole('owner')) {
            return redirect()->route('owner.dashboard');
        }

        if (auth()->user()->hasRole('pembeli')) {
            return redirect()->route('pembeli.dashboard');
        }
    }

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
Route::middleware([
    'auth',
    'role:admin',
])
->prefix('admin')
->name('admin.')
->group(function () {

    Route::get('/dashboard', [
        AdminController::class,
        'dashboard'
    ])->name('dashboard');

    Route::get('/reports', [
        AdminController::class,
        'reports'
    ])
    ->middleware('permission:view reports')
    ->name('reports');
});

// OWNER
Route::middleware([
    'auth',
    'role:owner',
])
->prefix('owner')
->name('owner.')
->group(function () {

    Route::get('/dashboard', [
        OwnerController::class,
        'dashboard'
    ])->name('dashboard');

    Route::resource(
        'playstations',
        PlaystationController::class
    )->middleware(
        'permission:manage playstations'
    );
});

/*
|--------------------------------------------------------------------------
| GUEST BOOKING
|--------------------------------------------------------------------------
*/

Route::get(
    '/booking',
    [BookingController::class, 'createGuest']
)->name('booking.guest.create');

Route::post(
    '/booking',
    [BookingController::class, 'storeGuest']
)->name('booking.guest.store');

// PEMBELI
Route::middleware([
    'auth',
    'role:pembeli',
])
->prefix('pembeli')
->name('pembeli.')
->group(function () {

    Route::get('/dashboard', [
        PembeliController::class,
        'dashboard'
    ])->name('dashboard');
    
    Route::get(
        'payments/{payment}/sync',
        [PaymentController::class, 'syncStatus']
    )->name('payments.sync');

    Route::resource(
        'bookings',
        BookingController::class
    )->middleware(
        'permission:manage bookings'
    );

    Route::resource(
        'payments',
        PaymentController::class
    )->middleware(
        'permission:manage payments'
    );
});

Route::post(
    '/midtrans/callback',
    [MidtransCallbackController::class, 'handle']
)->withoutMiddleware([
    \App\Http\Middleware\VerifyCsrfToken::class
]);

require __DIR__.'/auth.php';