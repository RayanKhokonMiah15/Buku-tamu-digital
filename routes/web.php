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
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routing untuk user biasa (profile dan report)
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Reports
    Route::resource('reports', ReportController::class)->only([
        'store', 'edit', 'update', 'destroy'
    ]);
});

// ============================
// ===== ADMIN AUTH ROUTES ====
// ============================

// Login Admin
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Logout Admin (gunakan dari AdminController agar konsisten)
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// ============================
// ===== ADMIN DASHBOARD =====
// ============================

Route::middleware('admin')->group(function () {
    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Kelola Laporan (Reports)
    Route::get('/admin/reports/{report}/edit', [AdminController::class, 'edit'])->name('admin.reports.edit');
    Route::put('/admin/reports/{report}', [AdminController::class, 'updateStatus'])->name('admin.reports.update');
    Route::delete('/admin/reports/{report}', [AdminController::class, 'destroy'])->name('admin.reports.destroy');

    // CRUD Guru
    Route::get('/admin/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::get('/admin/guru/create', [GuruController::class, 'create'])->name('guru.create');
    Route::post('/admin/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::get('/admin/guru/{id}/edit', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('/admin/guru/{id}', [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/admin/guru/{id}', [GuruController::class, 'destroy'])->name('guru.destroy');

});


   // Hapus route yang ada di dalam middleware admin
// Tambahkan ini di luar middleware:

Route::prefix('guru')->group(function() {
    // Halaman login guru (akses publik)
    Route::get('/login', [AkunGuruController::class, 'showLoginForm'])->name('guru.login');
    
    // Halaman dashboard guru (perlu autentikasi)
    Route::get('/dashboard', [AkunGuruController::class, 'index'])
         ->middleware('auth:guru') // Sesuaikan dengan guard yang digunakan
         ->name('guru.dashboard');
});


// Include routes dari Laravel Breeze/Fortify/Auth bawaan
require __DIR__ . '/auth.php';
