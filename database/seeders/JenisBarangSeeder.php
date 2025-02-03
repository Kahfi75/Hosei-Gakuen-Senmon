<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisBarangSeeder extends Seeder
{
    public function run()
    {
        DB::table('tr_jenis_barang')->insert([
            [
                'jns_brg_kode' => 'JNS01',
                'jns_brg_nama' => 'Elektronik',
            ],
            [
                'jns_brg_kode' => 'JNS02',
                'jns_brg_nama' => 'Peralatan Kantor',
            ],
            [
                'jns_brg_kode' => 'JNS03',
                'jns_brg_nama' => 'Mebel',
            ],
            // Tambahkan jenis barang lainnya jika perlu
        ]);
    }
}
