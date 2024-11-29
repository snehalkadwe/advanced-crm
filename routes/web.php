<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::middleware( 'role:admin'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('sales', SalesController::class);
    // });

    // Route::middleware(['auth', 'role:salesManager'])->group(function () {
    Route::resource('sales', SalesController::class)->only(['index', 'create', 'store']);
    // });
});


require __DIR__ . '/auth.php';
