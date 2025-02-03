<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // pastikan model User sudah ada

class UserSeeder extends Seeder
{
    public function run()
    {
        // Membuat user siswa dengan role 'siswa'
        User::create([
            'user_id' => 'SISW001',
            'user_nama' => 'Budi Santoso',
            'user_pass' => bcrypt('pass'), // Jangan lupa enkripsi password
            'user_hak' => 'user',  // Role siswa
            'user_sts' => '1', // Aktif
        ]);

        User::create([
            'user_id' => 'SISW002',
            'user_nama' => 'Ani Pratiwi',
            'user_pass' => bcrypt('123'),
            'user_hak' => 'user',  // Role siswa
            'user_sts' => '1', // Aktif
        ]);
    }
}
