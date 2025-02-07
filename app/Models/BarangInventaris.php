<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class BarangInventaris extends Model
{
    use HasFactory;

    protected $table = 'tm_barang_inventaris'; 
    protected $primaryKey = 'br_kode'; // Menentukan primary key jika berbeda dari default (id)
    public $incrementing = false; // Jika primary key tidak menggunakan auto increment
    protected $keyType = 'string'; // Menyesuaikan jika primary key berupa string

    protected $fillable = [
        'br_kode', 'br_nama', 'jns_brg_kode', 'br_tgl_terima', 'br_tgl_entry', 'br_status'
    ];

    // Perbaiki nama relasi di sini agar sesuai dengan yang digunakan di controller dan view
    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'jns_brg_kode', 'jns_brg_kode');
    }
}
