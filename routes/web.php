<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PlaystationController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

    Route::get('/dashboard',
        [AdminController::class, 'dashboard']);

});

Route::middleware(['auth', 'role:owner'])
    ->prefix('owner')
    ->group(function () {

    Route::get('/dashboard',
        [OwnerController::class, 'dashboard']);
    
    Route::resource('playstations', PlaystationController::class);
});

Route::middleware(['auth', 'role:pembeli'])
    ->prefix('pembeli')
    ->group(function () {

    Route::get('/dashboard',
        [PembeliController::class, 'dashboard']);
    
    Route::resource('bookings', BookingController::class);
    Route::resource('payments', PaymentController::class);

});



require __DIR__.'/auth.php';
