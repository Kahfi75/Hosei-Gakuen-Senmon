<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangInventaris extends Model
{
    use HasFactory;

    protected $table = 'tm_barang_inventaris';
    protected $primaryKey = 'br_kode'; // Adjust if necessary
    protected $fillable = ['br_kode', 'br_nama', 'jns_brg_kode', 'user_id', 'br_nama', 'br_tgl_terima', 'br_tgl_entry', 'br_status'];

    // Relationship with the JenisBarang model
    public function jenis_barang()
    {
        return $this->belongsTo(JenisBarang::class, 'br_kategori', 'jns_brg_kode');
    }
}


