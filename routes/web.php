<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BanjirController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Informasi Pelaporan Bencana Banjir (LaporBanjir)
| Badan Penanggulangan Bencana Daerah (BPBD) Kabupaten Bandung
|--------------------------------------------------------------------------
| Mengimplementasikan Autentikasi Manual (Tanpa Breeze) sesuai Modul 6:
| - Register, Login, Logout manual menggunakan RegisterController & LoginController
| - Proteksi middleware('auth') untuk halaman pengelolaan petugas BPBD
| - Form pelaporan warga bersifat publik tanpa kewajiban login
*/

// ==========================================
// 1. RUTE PUBLIK (Dapat Diakses Warga Tanpa Login)
// ==========================================

// Halaman Beranda / Portal Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Form Pelaporan Banjir untuk Warga & Proses Penyimpanan
Route::get('/banjir/form', [BanjirController::class, 'create'])->name('banjir.create');
Route::post('/banjir/store', [BanjirController::class, 'store'])->name('banjir.store');


// ==========================================
// 2. RUTE AUTENTIKASI MANUAL (Untuk Tamu / Guest)
// ==========================================
Route::middleware('guest')->group(function () {
    // Registrasi Petugas Baru
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    // Login Petugas
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

// Logout Petugas (POST wajib auth agar aman dari CSRF/link triggering)
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');


// ==========================================
// 3. RUTE TERPROTEKSI (Wajib Login Petugas BPBD - middleware 'auth')
// ==========================================
Route::middleware('auth')->group(function () {
    // Dashboard Operasional Petugas
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Profil Petugas BPBD
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');

    // Pengelolaan Daftar Laporan Banjir
    Route::get('/banjir', [BanjirController::class, 'index'])->name('banjir.index');
    Route::get('/banjir/{id}', [BanjirController::class, 'show'])->name('banjir.show');
});
