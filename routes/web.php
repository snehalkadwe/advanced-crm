<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\CustomerController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('sales', SalesController::class);
});
Route::middleware(['auth', 'role:salesManager'])->group(function () {
    Route::resource('sales', SalesController::class)->only(['index', 'create', 'store']);
});

Route::post('/sales/import', [SalesController::class, 'import'])->name('sales.import');
