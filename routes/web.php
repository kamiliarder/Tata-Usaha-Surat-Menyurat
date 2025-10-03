<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicPesanController;
use App\Http\Controllers\AdminPesanController;
use App\Http\Controllers\GuruPesanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Public routes (no authentication required)
Route::get('/', function () {
    return view('welcome');
});

// Public correspondence submission
Route::prefix('pesan')->name('public.pesan.')->group(function () {
    Route::get('/create', [PublicPesanController::class, 'create'])->name('create');
    Route::post('/store', [PublicPesanController::class, 'store'])->name('store');
    Route::get('/success', [PublicPesanController::class, 'success'])->name('success');
    Route::get('/staff-by-divisi', [PublicPesanController::class, 'getStaffByDivisi'])->name('staff-by-divisi');
});

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin routes (will add middleware later)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::prefix('pesan')->name('pesan.')->group(function () {
            Route::get('/', [AdminPesanController::class, 'index'])->name('index');
            Route::get('/{id}', [AdminPesanController::class, 'show'])->name('show');
            Route::patch('/{id}', [AdminPesanController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminPesanController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/reply', [AdminPesanController::class, 'createReply'])->name('create-reply');
            Route::post('/{id}/reply', [AdminPesanController::class, 'storeReply'])->name('store-reply');
        });
    });

    // Teacher routes (will add middleware later)
    Route::prefix('guru')->name('guru.')->group(function () {
        Route::get('/dashboard', [GuruPesanController::class, 'dashboard'])->name('dashboard');
        Route::prefix('pesan')->name('pesan.')->group(function () {
            Route::get('/', [GuruPesanController::class, 'index'])->name('index');
            Route::get('/{id}', [GuruPesanController::class, 'show'])->name('show');
            Route::patch('/{id}', [GuruPesanController::class, 'update'])->name('update');
        });
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include Volt routes for custom authentication
require __DIR__.'/volt.php';

// Comment out the default auth routes since we're using custom Volt routes
// require __DIR__.'/auth.php';
