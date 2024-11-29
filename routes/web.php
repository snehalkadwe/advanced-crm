<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::middleware( 'role:admin'])->group(function () {
    // Recycle Bin Routes
    Route::prefix('customers')->name('customers.')->group(function () {
        Route::get('/recycle-bin', [CustomerController::class, 'recycleBin'])->name('recycle-bin');
        Route::post('/restore/{id}', [CustomerController::class, 'restore'])->name('restore');
        Route::post('/import', [CustomerController::class, 'import'])->name('import');
        Route::get('/export', [CustomerController::class, 'export'])->name('export');
    });
    Route::prefix('sales')->name('sales.')->group(function () {
        Route::get('/recycle-bin', [SalesController::class, 'recycleBin'])->name('recycle-bin');
        Route::post('/restore/{id}', [SalesController::class, 'restore'])->name('restore');
        Route::post('/import', [SalesController::class, 'import'])->name('import');
        Route::get('/export', [SalesController::class, 'export'])->name('export');
    });
    Route::resource('customers', CustomerController::class);
    Route::resource('sales', SalesController::class);
    // });

    Route::get('/import-export', function () {
        return view('import-export');
    })->name('import-export');

    // Route::middleware(['auth', 'role:salesManager'])->group(function () {
    Route::resource('sales', SalesController::class)->only(['index', 'create', 'store']);
    // });
});


require __DIR__ . '/auth.php';
