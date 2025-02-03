<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBarang extends Model
{
    use HasFactory;

    // Menetapkan nama tabel yang benar
    protected $table = 'td_peminjaman_barang'; // Nama tabel yang benar
    protected $primaryKey = 'pbd_id'; // Primary key untuk model
    public $incrementing = false; // Jika primary key bukan auto increment
    public $timestamps = true; // Jika tabel menggunakan kolom created_at dan updated_at

    // Tentukan kolom yang dapat diisi (fillable)
    protected $fillable = [
        'pb_id',      // ID Peminjaman
        'br_kode',    // Kode Barang
        'pdb_tgl',    // Tanggal Peminjaman
        'pdb_sts',    // Status Peminjaman
    ];

    /**
     * Relasi ke tabel peminjaman
     */
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'pb_id', 'pb_id');
    }

    /**
     * Relasi ke tabel barang_inventaris
     */
    public function barangInventaris()
    {
        return $this->belongsTo(BarangInventaris::class, 'br_kode', 'br_kode');
    }

    /**
     * Ambil daftar barang yang belum dikembalikan
     */
    public static function barangBelumKembali()
    {
        // Pastikan Anda tidak menggunakan kolom 'tanggal_kembali' jika tidak ada
        return self::whereNull('pdb_sts')->get(); // Filter menggunakan kolom 'pdb_sts' untuk status peminjaman
    }
}
