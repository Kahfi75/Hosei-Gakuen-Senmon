<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('tr_jenis_barang', function (Blueprint $table) {
            $table->string('jns_brg_kode', 10)->primary();
            $table->string('jns_brg_nama', 100)->unique();
            $table->timestamps();
            $table->softDeletes(); // Menambahkan fitur soft delete
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_jenis_barang');
    }
};
