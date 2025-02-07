<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';  // Jika nama tabel tidak mengikuti konvensi Laravel
    protected $fillable = [
        'kode_barang', 'nama_barang', 'kategori', 'jumlah', 'status',
    ];
}
