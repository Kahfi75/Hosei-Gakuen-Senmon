<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tm_peminjaman', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('pb_id', 20)->primary();
            $table->string('user_id', 20)->nullable();
            $table->string('siswa_id', 10)->nullable();
            $table->dateTime('pb_tgl')->nullable();
            $table->dateTime('pb_harus_kembali_tgl')->nullable();
            $table->char('pb_stat', 2)->nullable();
            $table->timestamps();

        
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tm_peminjaman');
    }
};
