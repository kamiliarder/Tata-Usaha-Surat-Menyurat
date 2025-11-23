<?php

use App\Http\Controllers\PublicPesanController;
use App\Http\Controllers\AdminPesanController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AkunController;

// Public routes (no authentication required)
Route::get('/', [WelcomeController::class, 'index']);

// Public correspondence submission (no prefix to avoid conflict with authenticated routes)
Route::name('public.pesan.')->group(function () {
    Route::get('/public/pesan/create', [PublicPesanController::class, 'create'])->name('create');
    Route::post('/public/pesan/store', [PublicPesanController::class, 'store'])->name('store');
    Route::get('/public/pesan/success', [PublicPesanController::class, 'success'])->name('success');
});

// API routes for dynamic dropdowns
Route::prefix('api')->group(function () {
    Route::get('/pengguna/by-divisi/{divisi}', [PublicPesanController::class, 'getStaffByDivisi']);
});

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pesan (Correspondence) routes - no admin/teacher prefix
    Route::prefix('pesan')->name('pesan.')->group(function () {
        Route::get('/', [AdminPesanController::class, 'index'])->name('index');

        // Write operations - protected from 'guru' role by readonly middleware
        Route::middleware(['readonly'])->group(function () {
            Route::get('/create', [AdminPesanController::class, 'create'])->name('create');
            Route::post('/', [AdminPesanController::class, 'store'])->name('store');
            Route::patch('/{id}', [AdminPesanController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminPesanController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/reply', [AdminPesanController::class, 'createReply'])->name('create-reply');
            Route::post('/{id}/reply', [AdminPesanController::class, 'storeReply'])->name('store-reply');
        });

        // This must be after specific routes like /create to avoid matching "create" as an {id}
        Route::get('/{id}', [AdminPesanController::class, 'show'])->name('show');
    });

    // Account management routes
    // Index - accessible to all authenticated users
    Route::get('/akun', [AkunController::class, 'index'])->name('akun.index');

    // Create, Edit, Update, Delete - admin only (must be before {akun} routes)
    Route::middleware(['admin'])->group(function () {
        Route::get('/akun/create', [AkunController::class, 'create'])->name('akun.create');
        Route::post('/akun', [AkunController::class, 'store'])->name('akun.store');
        Route::get('/akun/{akun}/edit', [AkunController::class, 'edit'])->name('akun.edit');
        Route::put('/akun/{akun}', [AkunController::class, 'update'])->name('akun.update');
        Route::patch('/akun/{akun}', [AkunController::class, 'update']);
        Route::delete('/akun/{akun}', [AkunController::class, 'destroy'])->name('akun.destroy');
    });

    // Show - accessible to all authenticated users (must be after /akun/create)
    Route::get('/akun/{akun}', [AkunController::class, 'show'])->name('akun.show');
});


// Include Volt routes for custom authentication
require __DIR__.'/volt.php';
