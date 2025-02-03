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
        if (!Schema::hasTable('tm_pengembalian')) {
            Schema::create('tm_pengembalian', function (Blueprint $table) {
                $table->string('kembali_id', 20)->primary();
                $table->string('pb_id', 20);
                $table->string('user_id', 20);
                $table->dateTime('kembali_tgl')->nullable();
                $table->char('kembali_sts', 2)->nullable();
                $table->timestamps();

                // Menambahkan foreign key constraint jika tabel referensi sudah ada
                $table->foreign('pb_id')->references('pb_id')->on('tm_peminjaman')->onDelete('cascade');
                $table->foreign('user_id')->references('user_id')->on('tm_user')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_pengembalian');
    }
};
