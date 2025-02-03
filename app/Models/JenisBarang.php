<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;

    protected $table = 'tr_jenis_barang'; // Sesuaikan dengan nama tabel Anda
    protected $primaryKey = 'jns_brg_kode'; // Pastikan primary key di model sesuai
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'jns_brg_kode',
        'jns_brg_nama',
    ];

    /**
     * Relasi dengan model BarangInventaris
     * JenisBarang memiliki banyak BarangInventaris
     */
    // JenisBarang.php
public function barangInventaris()
{
    return $this->hasMany(BarangInventaris::class, 'jns_brg_kode', 'jns_brg_kode');
}

}
