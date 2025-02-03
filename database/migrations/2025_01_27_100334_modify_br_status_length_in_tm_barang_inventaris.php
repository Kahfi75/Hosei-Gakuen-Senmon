<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('tm_barang_inventaris', function (Blueprint $table) {
        $table->string('br_status', 50)->change(); // Menambahkan panjang kolom menjadi 50 karakter
    });
}

public function down()
{
    Schema::table('tm_barang_inventaris', function (Blueprint $table) {
        $table->string('br_status', 20)->change(); // Kembalikan panjang kolom jika perlu
    });
}

};
