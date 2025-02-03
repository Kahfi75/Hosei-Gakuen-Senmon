<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Pastikan DB diimport

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'tm_peminjaman';
    protected $primaryKey = 'pb_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'pb_tgl' => 'datetime',
        'pb_harus_kembali_tgl' => 'datetime',
    ];

    protected $fillable = [
        'pb_id',
        'user_id',
        'siswa_id',
        'pb_stat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'siswa_id');
    }

    public function peminjamanBarang()
    {
        return $this->hasMany(PeminjamanBarang::class, 'pb_id', 'pb_id');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'pb_id', 'pb_id');
    }

    public static function generatePbId()
    {
        // Tahun dan Bulan berjalan
        $tahun = date('Y');
        $bulan = date('m');

        // Mendapatkan nomor urut terakhir
        $noUrut = DB::table('tm_peminjaman')
            ->whereRaw("SUBSTRING(pb_id, 3, 4) = ?", [$tahun])
            ->whereRaw("SUBSTRING(pb_id, 7, 2) = ?", [$bulan])
            ->max(DB::raw("IFNULL(SUBSTRING(pb_id, 10, 3), 0)")) + 1;

        // Format ID Peminjaman: PJ+TAHUN+BULAN+NO_URUT (3 digit)
        return "PJ" . $tahun . $bulan . str_pad($noUrut, 3, '0', STR_PAD_LEFT);
    }
}
