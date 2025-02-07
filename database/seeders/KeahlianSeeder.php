<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeahlianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keahlian')->insert([
            ['nama_keahlian' => 'Pemrograman Web'],
            ['nama_keahlian' => 'Desain Grafis'],
            ['nama_keahlian' => 'Animasi 2D'],
            ['nama_keahlian' => 'Jaringan Komputer'],
            ['nama_keahlian' => 'Keamanan Cyber'],
        ]);
    }
}
