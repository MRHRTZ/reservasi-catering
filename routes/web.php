<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\AuthPelanggan;

Route::get('/', [LoginController::class, 'cek_login'])->name('index');
Route::get('/login', [LoginController::class, 'login_view'])->name('login');
Route::post('/login/proses', [LoginController::class, 'login_process'])->name('login-process');
Route::get('/register', [LoginController::class, 'register_view'])->name('register');
Route::post('/register/proses', [LoginController::class, 'register_process'])->name('register-process');
Route::get('/logout', [LoginController::class, 'logout_process'])->name('logout');

Route::middleware(AuthAdmin::class)->group(function () {
    // ADMIN
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/admin/pengguna', [PenggunaController::class, 'list_pengguna'])->name('admin.pengguna');
    Route::get('/admin/pengguna/create', [PenggunaController::class, 'buat_pengguna_view'])->name('admin.pengguna.create');
    Route::post('/admin/pengguna/create', [PenggunaController::class, 'buat_pengguna_proses'])->name('admin.pengguna.store');
    Route::get('/admin/pengguna/edit/{id}', [PenggunaController::class, 'edit_pengguna_view'])->name('admin.pengguna.edit');
    Route::post('/admin/pengguna/edit/{id}', [PenggunaController::class, 'edit_pengguna_proses'])->name('admin.pengguna.save');
    Route::get('/admin/pengguna/delete/{id}', [PenggunaController::class, 'hapus_pengguna'])->name('admin.pengguna.delete');
    Route::get('/admin/menu', [MenuController::class, 'list_menu'])->name('admin.menu');
    Route::get('/admin/menu/create', [MenuController::class, 'buat_menu_view'])->name('admin.menu.create');
    Route::post('/admin/menu/create', [MenuController::class, 'buat_menu_proses'])->name('admin.menu.store');
    Route::get('/admin/menu/edit/{id}', [MenuController::class, 'edit_menu_view'])->name('admin.menu.edit');
    Route::post('/admin/menu/edit/{id}', [MenuController::class, 'edit_menu_proses'])->name('admin.menu.save');
    Route::get('/admin/menu/delete/{id}', [MenuController::class, 'hapus_menu'])->name('admin.menu.delete');
    Route::get('/admin/pembayaran', [PembayaranController::class, 'list_pembayaran'])->name('admin.pembayaran');
    Route::get('/admin/pembayaran/create', [PembayaranController::class, 'buat_pembayaran_view'])->name('admin.pembayaran.create');
    Route::post('/admin/pembayaran/create', [PembayaranController::class, 'buat_pembayaran_proses'])->name('admin.pembayaran.store');
    Route::get('/admin/pembayaran/edit/{id}', [PembayaranController::class, 'edit_pembayaran_view'])->name('admin.pembayaran.edit');
    Route::post('/admin/pembayaran/edit/{id}', [PembayaranController::class, 'edit_pembayaran_proses'])->name('admin.pembayaran.save');
    Route::get('/admin/pembayaran/delete/{id}', [PembayaranController::class, 'hapus_pembayaran'])->name('admin.pembayaran.delete');
    Route::get('/admin/pesanan', [PesananController::class, 'list_pesanan'])->name('admin.pesanan');
    Route::get('/admin/pesanan/detail/{id_pesanan}', [PesananController::class, 'view_detail_pesanan_admin'])->name('admin.pesanan.detail');
    Route::get('/admin/pesanan/proses/{id_pesanan}', [PesananController::class, 'view_proses_pesanan'])->name('admin.pesanan.proses');
});

Route::middleware(AuthPelanggan::class)->group(function () {
    // USER
    Route::get('/pelanggan/dashboard', [DashboardController::class, 'pelanggan'])->name('pelanggan.dashboard');
    Route::get('/pelanggan/menu', [MenuController::class, 'view_menu'])->name('pelanggan.menu');
    Route::get('/pelanggan/keranjang', [KeranjangController::class, 'view_keranjang'])->name('pelanggan.keranjang');
    Route::post('/pelanggan/keranjang/menu/{id_menu}', [KeranjangController::class, 'proses_tambah_keranjang'])->name('pelanggan.keranjang.tambah');
    Route::post('/pelanggan/keranjang/ubah/{id}', [KeranjangController::class, 'proses_ubah_keranjang'])->name('pelanggan.keranjang.ubah');
    Route::post('/pelanggan/keranjang/hapus/{id}', [KeranjangController::class, 'proses_hapus_keranjang'])->name('pelanggan.keranjang.hapus');
    Route::post('/pelanggan/keranjang/checkout', [KeranjangController::class, 'proses_checkout'])->name('pelanggan.keranjang.checkout');
    Route::get('/pelanggan/checkout/{id_pesanan}', [CheckoutController::class, 'view_checkout'])->name('pelanggan.checkout');
    Route::post('/pelanggan/checkout/{id_pesanan}', [CheckoutController::class, 'proses_bayar'])->name('pelanggan.checkout.bayar');
    Route::get('/pelanggan/pesanan', [PesananController::class, 'view_pesanan'])->name('pelanggan.pesanan');
    Route::get('/pelanggan/pesanan/detail/{id_pesanan}', [PesananController::class, 'view_detail_pesanan'])->name('pelanggan.pesanan.detail');
});
