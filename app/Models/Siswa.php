<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'siswa_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'siswa_id',
        'nisn',
        'nama_siswa',
        'Keahlian_id',
        'kelas_id',
        'no_siswa',
    ];

    public function jurusan()
    {
    return $this->belongsTo(Keahlian::class, 'Keahlian_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id', 'id');
    }
}
