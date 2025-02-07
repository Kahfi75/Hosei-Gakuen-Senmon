<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswa')->insert([
            ['siswa_id' => 'S001', 'nisn' => '0001',  'nama_siswa' => 'Agus Saputra', 'kelas_id' => '10'],
            ['siswa_id' => 'S002', 'nisn' => '0002', 'nama_siswa' => 'Rina Mutiara', 'kelas_id' => '10'],
            ['siswa_id' => 'S003', 'nisn' => '0003' ,'nama_siswa' => 'Budi Setiawan', 'kelas_id' => '11'],
            ['siswa_id' => 'S004', 'nisn' => '0004', 'nama_siswa' => 'Dewi Susanti', 'kelas_id' => '12'],
            ['siswa_id' => 'S005', 'nisn' => '0005', 'nama_siswa' => 'Irfan Kurniawan', 'kelas_id' => '12'],
            ['siswa_id' => 'S006', 'nisn' => '0006', 'nama_siswa' => 'Siti Aisyah', 'kelas_id' => '10'],
        ]);
    }
}
