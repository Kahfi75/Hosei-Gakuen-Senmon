<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel kelas.
     */
    public function run()
    {
        DB::table('kelas')->insert([
            ['id' => 10, 'nama_kelas' => 'X Teknik Informatika'],
            ['id' => 11, 'nama_kelas' => 'XI Teknik Informatika'],
            ['id' => 12, 'nama_kelas' => 'XII Teknik Informatika'],
        ]);
    }
}
