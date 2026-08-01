<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

// ---- Auth (KK-01) ----
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ---- Dashboard per role ----
Route::middleware(['auth', 'role:Pelayan'])->group(function () {
    Route::get('/pelayan/dashboard', [DashboardController::class, 'pelayan'])->name('pelayan.dashboard');
});

Route::middleware(['auth', 'role:Koki'])->group(function () {
    Route::get('/koki/dashboard', [DashboardController::class, 'koki'])->name('koki.dashboard');
});

Route::middleware(['auth', 'role:Kasir'])->group(function () {
    Route::get('/kasir/dashboard', [DashboardController::class, 'kasir'])->name('kasir.dashboard');
});