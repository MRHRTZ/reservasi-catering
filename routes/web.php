<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'cek_login'])->name('index');
Route::get('/login', [LoginController::class, 'login_view'])->name('login');
Route::post('/login/proses', [LoginController::class, 'login_process'])->name('login-process');
Route::get('/register', [LoginController::class, 'register_view'])->name('register');
Route::post('/register/proses', [LoginController::class, 'register_process'])->name('register-process');
Route::get('/logout', [LoginController::class, 'logout_process'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // ADMIN
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/admin/pengguna', [PenggunaController::class, 'list_pengguna'])->name('admin.pengguna');
    Route::get('/admin/pengguna/create', [PenggunaController::class, 'buat_pengguna_view'])->name('admin.pengguna.create');
    Route::post('/admin/pengguna/create', [PenggunaController::class, 'buat_pengguna_proses'])->name('admin.pengguna.store');
    Route::get('/admin/pengguna/edit/{id}', [PenggunaController::class, 'edit_pengguna_view'])->name('admin.pengguna.edit');
    Route::post('/admin/pengguna/edit/{id}', [PenggunaController::class, 'edit_pengguna_proses'])->name('admin.pengguna.save');
    Route::get('/admin/pengguna/delete/{id}', [PenggunaController::class, 'hapus_pengguna'])->name('admin.pengguna.delete');
    Route::get('/admin/menu', [MenuController::class, 'list_menu'])->name('admin.menu');
    Route::get('/admin/pesanan', [PesananController::class, 'list_pesanan'])->name('admin.pesanan');

    // USER
});
