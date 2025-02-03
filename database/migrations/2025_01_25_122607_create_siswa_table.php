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
        Schema::create('siswa', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Gunakan InnoDB untuk foreign key

            $table->string('siswa_id', 10)->primary(); // Primary key
            $table->string('nama', 100); // Nama siswa
            $table->string('kelas_id', 10); // Foreign key ke tabel kelas

            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
