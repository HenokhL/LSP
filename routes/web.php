<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\Usercontroller; 
use App\Http\Controllers\PersediaanController;
use App\Http\Controllers\LaporanController; 
use Illuminate\Support\Facades\Route;

// Auth routes
Route::get('/',        [AuthController::class, 'index'])->name('auth.index');
Route::get('/auth',    [AuthController::class, 'index'])->name('auth.login');
Route::post('/login',  [AuthController::class, 'login'])->name('auth.doLogin');
Route::get('/logout',  [AuthController::class, 'logout'])->name('auth.logout');

// Protected routes
Route::middleware('auth.session')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data Barang
    Route::get('/barang',            [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/tambah',     [BarangController::class, 'tambah'])->name('barang.tambah');
    Route::post('/barang/simpan',    [BarangController::class, 'simpan'])->name('barang.simpan');
    Route::get('/barang/edit/{id}',  [BarangController::class, 'edit'])->name('barang.edit');
    Route::post('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::get('/barang/hapus/{id}',   [BarangController::class, 'hapus'])->name('barang.hapus');

    // Kategori Barang
    Route::get('/kategori',          [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori/simpan',  [KategoriController::class, 'simpan'])->name('kategori.simpan');
    Route::post('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::get('/kategori/hapus/{id}',   [KategoriController::class, 'hapus'])->name('kategori.hapus');

    // Manajemen Users
    Route::get('/users',             [Usercontroller::class, 'index'])->name('users.index');
    Route::post('/users/simpan',     [Usercontroller::class, 'simpan'])->name('users.simpan');
    Route::post('/users/update/{id}', [Usercontroller::class, 'update'])->name('users.update');
    Route::get('/users/hapus/{id}',   [Usercontroller::class, 'hapus'])->name('users.hapus');

    // LAPORAN TRANSAKSI
    Route::get('/laporan', [LaporanController::class, 'laporan'])->name('laporan.index');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');

    // Manajemen Persediaan
    Route::get('/persediaan', [PersediaanController::class, 'index'])->name('persediaan.index');
    Route::post('/persediaan/store-masuk', [PersediaanController::class, 'storeMasuk'])->name('persediaan.storeMasuk');
    Route::post('/persediaan/store-keluar', [PersediaanController::class, 'storeKeluar'])->name('persediaan.storeKeluar');
    
    Route::get('/barang/masuk', [PersediaanController::class, 'index'])->name('barang.masuk');
    Route::get('/barang/keluar', [PersediaanController::class, 'index'])->name('barang.keluar');
    Route::post('/barang/masuk/simpan', [PersediaanController::class, 'storeMasuk'])->name('barang.simpanMasuk');
    Route::post('/barang/keluar/simpan', [PersediaanController::class, 'storeKeluar'])->name('barang.simpanKeluar');
});