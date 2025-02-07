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
        Schema::create('siswa', function (Blueprint $table) {
            $table->string('siswa_id', 20)->primary();  // Ganti id dengan siswa_id
            $table->string('nisn', 15)->nullable();   
            $table->string('nama_siswa', 100);        
            $table->unsignedBigInteger('jurusan_id')->nullable();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->string('no_siswa', 20)->nullable(); 
            $table->timestamps();  

            $table->foreign('jurusan_id')->references('id')->on('jurusan');
            $table->foreign('kelas_id')->references('id')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
