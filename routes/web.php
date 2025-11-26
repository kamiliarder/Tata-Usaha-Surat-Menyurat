<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicPesanController;
use App\Http\Controllers\AdminPesanController;
use App\Http\Controllers\GuruPesanController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AkunController;

// Route publik (nggak perlu login)
Route::get('/', [WelcomeController::class, 'index']);

// Form kirim surat dari publik (tanpa prefix biar nggak konflik sama route yang perlu login)
Route::name('public.pesan.')->group(function () {
    Route::get('/public/pesan/create', [PublicPesanController::class, 'create'])->name('create');
    Route::post('/public/pesan/store', [PublicPesanController::class, 'store'])->name('store');
    Route::get('/public/pesan/success', [PublicPesanController::class, 'success'])->name('success');
});

// Route yang perlu login dulu
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Pesan (Surat-Menyurat)
    Route::prefix('pesan')->name('pesan.')->group(function () {
        // Arahkan ke controller yang sesuai berdasarkan role user
        Route::get('/', function () {
            if (Auth::user()->role === 'guru') {
                return app(GuruPesanController::class)->index(request());
            }
            return app(AdminPesanController::class)->index(request());
        })->name('index');

        // Middleware readonly buat role guru
        Route::middleware(['readonly'])->group(function () {
            Route::get('/create', [AdminPesanController::class, 'create'])->name('create');
            Route::post('/', [AdminPesanController::class, 'store'])->name('store');
            Route::patch('/{id}', [AdminPesanController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminPesanController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/reply', [AdminPesanController::class, 'createReply'])->name('create-reply');
            Route::post('/{id}/reply', [AdminPesanController::class, 'storeReply'])->name('store-reply');
        });

        // Arahkan ke controller yang sesuai berdasarkan role user
        Route::get('/{id}', function ($id, Request $request) {
            if (Auth::user()->role === 'guru') {
                return app(GuruPesanController::class)->show($id, $request);
            }
            return app(AdminPesanController::class)->show($id, $request);
        })->name('show');
    });

    // Route manajemen akun
    // Index - bisa diakses semua user yang udah login
    Route::get('/akun', [AkunController::class, 'index'])->name('akun.index');

    // Create, Edit, Update, Delete - khusus admin
    Route::middleware(['admin'])->group(function () {
        Route::get('/akun/create', [AkunController::class, 'create'])->name('akun.create');
        Route::post('/akun', [AkunController::class, 'store'])->name('akun.store');
        Route::get('/akun/{akun}/edit', [AkunController::class, 'edit'])->name('akun.edit');
        Route::put('/akun/{akun}', [AkunController::class, 'update'])->name('akun.update');
        Route::patch('/akun/{akun}', [AkunController::class, 'update']);
        Route::delete('/akun/{akun}', [AkunController::class, 'destroy'])->name('akun.destroy');
    });

    // Show - bisa diakses semua user yang udah login
    Route::get('/akun/{akun}', [AkunController::class, 'show'])->name('akun.show');
});

// Include route Volt untuk autentikasi custom
require __DIR__.'/volt.php';
