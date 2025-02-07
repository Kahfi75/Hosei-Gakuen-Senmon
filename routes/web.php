<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\DaftarBarangController;
use App\Http\Controllers\BarangInventarisController;
use App\Http\Controllers\SuperUserController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Middleware\AuthCheck;

// **Route untuk dashboard utama**
Route::get('/', [SuperUserController::class, 'index'])->name('dashboard')->middleware(AuthCheck::class);

// **Route untuk Super User**
Route::prefix('super_user')->name('super_user.')->middleware(AuthCheck::class)->group(function () {
    // Dashboard Super User
    Route::get('/dashboard', [SuperUserController::class, 'index'])->name('dashboard');

    // **Route untuk Peminjaman**
    Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');

    // **Route untuk Barang Inventaris (CRUD lengkap)**
    Route::get('baranginventaris', [DaftarBarangController::class, 'index'])->name('baranginventaris.index');
    Route::get('baranginventaris/edit/{id}', [DaftarBarangController::class, 'edit'])->name('baranginventaris.edit');
    Route::put('baranginventaris/edit/{br_kode}', [DaftarBarangController::class, 'update'])->name('baranginventaris.update');
    Route::delete('baranginventaris/{id}', [DaftarBarangController::class, 'destroy'])->name('baranginventaris.destroy');

    // **Route untuk Penerimaan Barang**
    Route::get('baranginventaris/penerimaan', [BarangInventarisController::class, 'penerimaanBarang'])->name('baranginventaris.penerimaan');
    Route::post('baranginventaris/store', [BarangInventarisController::class, 'store'])->name('baranginventaris.store');

    // **Route untuk Daftar Barang**
    Route::get('baranginventaris/daftar', [DaftarBarangController::class, 'index'])->name('baranginventaris.daftar');
});

// **Route untuk Dashboard**
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(AuthCheck::class)->name('dashboard');
