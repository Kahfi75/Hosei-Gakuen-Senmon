<?php

// app/Models/Barang.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';  // nama tabel
    protected $primaryKey = 'id'; // primary key
    protected $fillable = [
        'kode_barang', 'nama_barang', 'kategori', 'jumlah', 'status'
    ];

    // Fungsi untuk mendapatkan status barang
    public function getStatusAttribute($value)
    {
        return ucfirst($value); // mengubah status menjadi kapital pertama
    }
}
