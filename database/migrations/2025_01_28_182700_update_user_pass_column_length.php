<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserPassColumnLength extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tm_user', function (Blueprint $table) {
            // Memperbarui panjang kolom user_pass menjadi 255 karakter
            $table->string('user_pass', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tm_user', function (Blueprint $table) {
            // Mengembalikan panjang kolom user_pass jika migrasi dibatalkan
            $table->string('user_pass', 100)->change();
        });
    }
}
