<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffEditController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MejaController;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. RUTE MODUL RESTORAN (Menu & Meja)
// ==========================================
Route::resource('meja', MejaController::class);
Route::resource('menu', MenuController::class);


// ==========================================
// 2. RUTE AUTENTIKASI (Belum Login)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
});


// ==========================================
// 3. RUTE SETELAH LOGIN (Admin & Pegawai)
// ==========================================
Route::middleware('auth')->group(function () {
    // Proses Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // SEMUA user (Admin & Pegawai) diarahkan ke Dashboard Utama dulu saat masuk
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // Halaman Profil Pegawai (bisa diakses via link/tombol)
    Route::get('/profil', [StaffController::class, 'profil'])->name('staff.profil');
});


// ==========================================
// 4. RUTE KHUSUS ADMIN (CRUD Penuh Staff/Pegawai)
// ==========================================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
    Route::get('/staff/{staff}/edit', [StaffEditController::class, 'edit'])->name('staff.edit');
    Route::put('/staff/{staff}', [StaffEditController::class, 'update'])->name('staff.update');
    Route::delete('/staff/{staff}', [StaffController::class, 'destroy'])->name('staff.destroy');
});