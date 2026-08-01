<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PemrosesanController;
use App\Http\Controllers\PenyajianController;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

// ---- Auth (KK-01) ----
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ---- Pelayan ----
Route::middleware(['auth', 'role:Pelayan'])->group(function () {
    Route::get('/pelayan/dashboard', [DashboardController::class, 'pelayan'])->name('pelayan.dashboard');

    // Modul Meja (Pro-1)
    Route::get('/pelayan/meja', [MejaController::class, 'index'])->name('pelayan.meja.index');
    Route::post('/pelayan/meja/{meja}/pilih', [MejaController::class, 'pilih'])->name('pelayan.meja.pilih');

    // Modul Pemesanan (Pro-2)
    Route::get('/pelayan/pesanan', [PesananController::class, 'index'])->name('pelayan.pesanan.index');
    Route::get('/pelayan/pesanan/create/{meja}', [PesananController::class, 'create'])->name('pelayan.pesanan.create');
    Route::post('/pelayan/pesanan/{meja}', [PesananController::class, 'store'])->name('pelayan.pesanan.store');

    // Modul Penyajian (Pro-4)
    Route::get('/pelayan/penyajian', [PenyajianController::class, 'index'])->name('pelayan.penyajian.index');
    Route::post('/pelayan/penyajian/{pesanan}/sajikan', [PenyajianController::class, 'sajikan'])->name('pelayan.penyajian.sajikan');
});

// ---- Koki ----
Route::middleware(['auth', 'role:Koki'])->group(function () {
    Route::get('/koki/dashboard', [DashboardController::class, 'koki'])->name('koki.dashboard');

    // Modul Menu (Pro-7)
    Route::get('/koki/menu', [MenuController::class, 'index'])->name('koki.menu.index');
    Route::get('/koki/menu/create', [MenuController::class, 'create'])->name('koki.menu.create');
    Route::post('/koki/menu', [MenuController::class, 'store'])->name('koki.menu.store');
    Route::get('/koki/menu/{menu}/edit', [MenuController::class, 'edit'])->name('koki.menu.edit');
    Route::put('/koki/menu/{menu}', [MenuController::class, 'update'])->name('koki.menu.update');
    Route::delete('/koki/menu/{menu}', [MenuController::class, 'destroy'])->name('koki.menu.destroy');

    // Modul Pemrosesan Pesanan (Pro-3)
    Route::get('/koki/pemrosesan', [PemrosesanController::class, 'index'])->name('koki.pemrosesan.index');
    Route::post('/koki/pemrosesan/{pesanan}/selesai', [PemrosesanController::class, 'selesai'])->name('koki.pemrosesan.selesai');
    Route::post('/koki/pemrosesan/{pesanan}/bahan-habis/{menu}', [PemrosesanController::class, 'bahanHabis'])->name('koki.pemrosesan.bahanHabis');
});

// ---- Kasir ----
Route::middleware(['auth', 'role:Kasir'])->group(function () {
    Route::get('/kasir/dashboard', [DashboardController::class, 'kasir'])->name('kasir.dashboard');
});