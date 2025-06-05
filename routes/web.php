<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AkunGuruController;
use App\Http\Controllers\GuruController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Halaman dashboard user biasa
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Routing untuk user biasa (profile dan report)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('reports', ReportController::class)->only([
        'store',
        'show',
        'edit',
        'update',
        'destroy'
    ]);
});

// ============================
// ===== ADMIN AUTH ROUTES ====
// ============================
Route::middleware('guest:admin')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

Route::middleware('auth:admin')->group(function () {
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

// ============================
// ===== ADMIN DASHBOARD =====
// ============================
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/reports/{report}/edit', [AdminController::class, 'edit'])->name('admin.reports.edit');
    Route::put('/admin/reports/{report}', [AdminController::class, 'updateStatus'])->name('admin.reports.update');
    Route::delete('/admin/reports/{report}', [AdminController::class, 'destroy'])->name('admin.reports.destroy');

    // CRUD Guru
    Route::prefix('admin')->group(function () {
        Route::resource('guru', GuruController::class)->except(['show']);
    });
});

// ============================
// ===== GURU AUTH ROUTES =====
// ============================
Route::prefix('guru')->name('guru.')->group(function () {
    // Public routes (accessible without auth)
    Route::middleware('guest:guru')->group(function () {
        Route::get('/login', [AkunGuruController::class, 'showLoginForm'])->name('login.form');
        Route::post('/login', [AkunGuruController::class, 'login'])->name('login');
    });

    // Protected routes (require guru auth)
    Route::middleware('auth:guru')->group(function () {
        Route::post('/logout', [AkunGuruController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AkunGuruController::class, 'dashboard'])->name('dashboard');

        // Report handling routes
        Route::post('/reports/handle/{report}', [ReportController::class, 'handleReport'])->name('reports.handle');
        Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
        Route::get('/reports/{report}/edit', [ReportController::class, 'edit'])->name('reports.edit');
        Route::put('/reports/{report}', [ReportController::class, 'update'])->name('reports.update');
        Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');
    });
});

require __DIR__ . '/auth.php';
