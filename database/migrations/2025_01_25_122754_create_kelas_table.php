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
        // Membuat tabel 'kelas'
        Schema::create('kelas', function (Blueprint $table) {
            $table->string('kelas_id', 10)->primary(); // Kolom ID kelas sebagai primary key
            $table->string('nama_kelas', 100); // Kolom untuk nama kelas

            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel 'kelas' jika ada
        Schema::dropIfExists('kelas');
    }
};
