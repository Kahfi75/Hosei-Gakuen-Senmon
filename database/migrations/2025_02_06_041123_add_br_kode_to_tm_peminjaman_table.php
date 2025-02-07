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
         Schema::table('tm_peminjaman', function (Blueprint $table) {
             $table->string('br_kode'); // Add the column 'br_kode'
         });
     }
     
     public function down()
     {
         Schema::table('tm_peminjaman', function (Blueprint $table) {
             $table->dropColumn('br_kode');
         });
     }
     
};
