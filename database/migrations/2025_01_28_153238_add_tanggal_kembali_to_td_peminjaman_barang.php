<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('td_peminjaman_barang', function (Blueprint $table) {
            // Menambahkan kolom tanggal_kembali
            $table->dateTime('tanggal_kembali')->nullable(); // Menambahkan kolom tanggal_kembali
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('td_peminjaman_barang', function (Blueprint $table) {
            // Menghapus kolom tanggal_kembali
            $table->dropColumn('tanggal_kembali');
        });
    }
};
