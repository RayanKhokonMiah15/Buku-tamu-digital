<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;

// 127.0.0.1:8000/ aja
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
});

Route::middleware(['auth'])->group(function () {
    Route::resource('reports', ReportController::class)->only([
        'store',
        'edit',
        'update',
        'destroy'
    ]);
});

// Ini Buat routing autentikasi admin di 127.0.0.1:8000/admin/
Route::get('/admin/login', [\App\Http\Controllers\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [\App\Http\Controllers\AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [\App\Http\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout');

// Ini Buat routing admin panel
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

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

require __DIR__ . '/auth.php';
