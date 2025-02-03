<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangInventaris extends Model
{
    use HasFactory;

    protected $table = 'tm_barang_inventaris';
    protected $primaryKey = 'br_kode'; 
    protected $fillable = ['br_kode', 'br_nama', 'jns_brg_kode', 'user_id', 'br_tgl_terima', 'br_tgl_entry', 'br_status'];
    public $incrementing = false; // Karena primary key bukan auto-increment
    protected $keyType = 'string'; // Primary key bertipe string

    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'jns_brg_kode', 'jns_brg_kode');
    }

}
