<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'tm_peminjaman'; // Nama tabel sesuai skema
    protected $primaryKey = 'pb_id'; // Primary key
    public $incrementing = false; // Karena 'pb_id' bukan auto-increment
    protected $keyType = 'string'; // Tipe primary key adalah string (UUID)

    protected $fillable = [
        'pb_id', 
        'user_id', 
        'siswa_id', 
        'pb_tgl', 
        'pb_harus_kembali_tgl', 
        'pb_stat'
    ];

    protected $casts = [
        'pb_tgl' => 'datetime', // Pastikan format tanggal
        'pb_harus_kembali_tgl' => 'datetime',
    ];

    // Pastikan UUID di-generate sebelum menyimpan data
    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->pb_id) {
                $model->pb_id = Str::uuid();  // Generate UUID otomatis
            }
        });
    }

    /**
     * Relasi ke tabel siswa.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'siswa_id');
    }

    /**
     * Relasi ke tabel user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
