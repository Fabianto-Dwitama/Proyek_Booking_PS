<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PlaystationController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware([
    'auth',
    'verified'
])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:admin'
])
->prefix('admin')
->group(function () {

    Route::get(
        '/dashboard',
        [AdminController::class, 'dashboard']
    );

    Route::get(
        '/bookings',
        [AdminController::class, 'bookings']
    );

    Route::get(
        '/users',
        [AdminController::class, 'users']
    );

    Route::get(
        '/transactions',
        [AdminController::class, 'transactions']
    );

    Route::delete(
        '/bookings/{id}',
        [AdminController::class, 'destroyBooking']
    );

    Route::delete(
        '/users/{id}',
        [AdminController::class, 'destroyUser']
    );

});

/*
|--------------------------------------------------------------------------
| OWNER
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:owner'
])
->prefix('owner')
->group(function () {

    Route::get(
        '/dashboard',
        [OwnerController::class, 'dashboard']
    );

    Route::resource(
        'playstations',
        PlaystationController::class
    );

    Route::get(
        '/bookings',
        [OwnerController::class, 'bookings']
    );

    Route::get(
        '/payments',
        [OwnerController::class, 'payments']
    );

    Route::patch(
        '/payments/{id}/verify',
        [OwnerController::class, 'verifyPayment']
    );

    Route::patch(
        '/payments/{id}/reject',
        [OwnerController::class, 'rejectPayment']
    );

    Route::get(
        '/profile',
        [OwnerController::class, 'profile']
    );

    Route::post(
        '/profile',
        [OwnerController::class, 'updateProfile']
    );

});

/*
|--------------------------------------------------------------------------
| PEMBELI
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:pembeli'
])
->prefix('pembeli')
->group(function () {

    Route::get(
        '/dashboard',
        [PembeliController::class, 'dashboard']
    );

    Route::resource(
        'bookings',
        BookingController::class
    );

    Route::resource(
        'payments',
        PaymentController::class
    );

});

require __DIR__.'/auth.php';