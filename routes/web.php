<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenerimaanBarangController;
use App\Http\Controllers\BarangInventarisController;
use App\Http\Controllers\LaporanBarang;
use App\Http\Controllers\SuperUserController;
use App\Http\Controllers\PeminjamanBarangController;
use App\Http\Controllers\PengembalianController;
use Illuminate\Support\Facades\Auth;

// Halaman utama
Route::get('/', function () {
    return view('layout.admin');
});

Route::get('/', function() {
    return view('login');
})->name('login');

// Auth Routes (Login, Register, etc.)
// Auth::routes();

// Route untuk Super User (su) dan dashboard
Route::prefix('su')->name('super_user.')->group(function () {
    // Halaman utama Super User dan dashboard
    Route::get('/', [SuperUserController::class, 'su'])->name('su');
    Route::get('/dashboard', [SuperUserController::class, 'index'])->name('dashboard');

    // Route untuk penerimaan barang
    Route::get('barang-inventaris/penerimaan', [PenerimaanBarangController::class, 'penerimaan'])->name('baranginventaris.penerimaan');
    Route::post('barang-inventaris/store', [PenerimaanBarangController::class, 'store'])->name('baranginventaris.store');

    // Route untuk halaman daftar barang inventaris
    Route::get('barang-inventaris/daftar', [BarangInventarisController::class, 'index'])->name('baranginventaris.daftar');

    // Route untuk resource BarangInventaris (CRUD) untuk Super User
    Route::resource('barang-inventaris', BarangInventarisController::class)->except(['create', 'edit']);

    // Route untuk menghapus Barang Inventaris
    Route::delete('barang-inventaris/{id}', [BarangInventarisController::class, 'destroy'])->name('baranginventaris.destroy');

    // Route untuk peminjaman barang
    Route::get('peminjaman-barang', [PeminjamanBarangController::class, 'index'])->name('peminjaman.index');
    Route::post('peminjaman-barang/simpan', [PeminjamanBarangController::class, 'store'])->name('peminjaman.store');

    // Form pengembalian barang
    Route::get('peminjaman-barang/pengembalian', [PengembalianController::class, 'showFormPengembalian'])->name('peminjaman.pengembalian');

    // Proses pengembalian barang
    Route::post('peminjaman-barang/pengembalian', [PengembalianController::class, 'simpanPengembalian'])->name('peminjaman.simpanPengembalianBarang');

    // Daftar barang yang belum dikembalikan
    Route::get('peminjaman-barang/barang-belum-kembali', [PeminjamanBarangController::class, 'barangBelumKembali'])->name('peminjaman.barangBelumKembali');
});

// Route untuk penerimaan barang (tanpa prefix 'su')
Route::get('penerimaan', [PenerimaanBarangController::class, 'penerimaan'])->name('penerimaan.create');
Route::post('penerimaan', [PenerimaanBarangController::class, 'store'])->name('penerimaan.store');

// Route untuk Super User dengan middleware auth
Route::prefix('super_user')
    ->name('super_user.')
    // ->middleware('auth')
    ->group(function () {
    // Menampilkan form pengembalian barang
    Route::get('/peminjaman/return-form', [PeminjamanBarangController::class, 'returnForm'])->name('peminjaman.returnForm');
    
    // Route untuk Barang Inventaris
    Route::get('baranginventaris/form', [BarangInventarisController::class, 'showForm'])->name('baranginventaris.form');
    Route::post('baranginventaris/store', [BarangInventarisController::class, 'store'])->name('baranginventaris.store');
    Route::delete('baranginventaris/{br_kode}', [BarangInventarisController::class, 'destroy'])->name('baranginventaris.destroy');
});

// Route untuk laporan
Route::prefix('laporan')->name('laporan.')->group(function () {
    Route::get('/barang', [LaporanBarang::class, 'index'])->name('barang');
    Route::get('/pengembalian', [LaporanBarang::class, 'pengembalian'])->name('pengembalian');
    Route::get('/status', [LaporanBarang::class, 'status'])->name('status');
});

// Route untuk menghapus barang inventaris
Route::delete('/super_user/baranginventaris/{br_kode}', [BarangInventarisController::class, 'destroy'])->name('super_user.baranginventaris.destroy');
