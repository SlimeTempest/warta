<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\AdminInstansiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\SuperAdminLaporanController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;

// Public routes
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset routes (public)
Route::get('/password/reset', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [PasswordResetController::class, 'reset'])->name('password.update');

// Dashboard routes (protected by auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard/user', [DashboardController::class, 'user'])->name('dashboard.user');
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/dashboard/super-admin', [DashboardController::class, 'superAdmin'])->name('dashboard.super_admin');
    
    // User management routes (only for super admin)
    Route::resource('users', UserController::class)->except(['show']);
    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
    Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.resetPassword');
    
    // Instansi management routes (only for super admin)
    Route::resource('instansi', InstansiController::class);
    Route::post('/instansi/{instansi}/toggle-status', [InstansiController::class, 'toggleStatus'])->name('instansi.toggleStatus');
    
    // Admin-Instansi management routes (only for super admin)
    Route::post('/admin-instansi', [AdminInstansiController::class, 'store'])->name('admin-instansi.store');
    Route::delete('/admin-instansi/{userId}/{instansiId}', [AdminInstansiController::class, 'destroy'])->name('admin-instansi.destroy');
    Route::get('/admin-instansi', [AdminInstansiController::class, 'index'])->name('admin-instansi.index');
    
    // Laporan routes (for users only)
    Route::resource('laporan', LaporanController::class);
    
    // Admin laporan routes (for admins)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/{laporan}', [AdminLaporanController::class, 'show'])->name('laporan.show');
        Route::post('/laporan/{laporan}/claim', [AdminLaporanController::class, 'claim'])->name('laporan.claim');
        Route::put('/laporan/{laporan}/status', [AdminLaporanController::class, 'updateStatus'])->name('laporan.updateStatus');
    });

    // Super Admin laporan routes (for super admins)
    Route::prefix('super-admin')->name('super-admin.')->group(function () {
        Route::get('/laporan', [SuperAdminLaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/{laporan}', [SuperAdminLaporanController::class, 'show'])->name('laporan.show');
        Route::get('/laporan/{laporan}/edit', [SuperAdminLaporanController::class, 'edit'])->name('laporan.edit');
        Route::put('/laporan/{laporan}', [SuperAdminLaporanController::class, 'update'])->name('laporan.update');
        Route::delete('/laporan/{laporan}', [SuperAdminLaporanController::class, 'destroy'])->name('laporan.destroy');
    });

    // Profile routes (for all authenticated users)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('/profile/generate-token', [ProfileController::class, 'generateNewToken'])->name('profile.generateToken');
});
