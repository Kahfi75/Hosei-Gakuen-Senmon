<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'tm_peminjaman'; // Nama tabel di database
    protected $primaryKey = 'pb_id';    // Kolom primary key
    public $incrementing = false;      // Karena primary key bukan auto-increment
    protected $keyType = 'string';     // Primary key bertipe string

    // Kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'pb_id',
        'siswa_id',
        'pb_tgl',
        'pb_harus_kembali_tgl',
        'pb_stat',
    ];

    // Relasi dengan tabel `PeminjamanBarang`
    public function peminjamanBarang()
    {
        return $this->hasMany(PeminjamanBarang::class, 'pb_id', 'pb_id');
    }

    // Relasi dengan tabel `Siswa`
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'siswa_id');
    }

    // Generate ID Peminjaman
    public static function generatePbId()
    {
        $tahun = date('Y');
        $lastId = self::whereYear('pb_tgl', $tahun)
            ->orderBy('pb_id', 'desc')
            ->pluck('pb_id')
            ->first();

        $nextId = $lastId ? intval(substr($lastId, -4)) + 1 : 1;
        return "PB{$tahun}" . str_pad($nextId, 4, '0', STR_PAD_LEFT);
    }
}

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\BarangInventaris;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    // Menampilkan daftar peminjaman dan form peminjaman
    public function index()
    {
        // Ambil semua data peminjaman, barang, dan siswa
        $peminjaman = Peminjaman::with('peminjamanBarang', 'siswa')->get();
        $barang = BarangInventaris::where('br_status', 'Ada')->get(); // Hanya barang yang tersedia
        $siswa = Siswa::all();

        return view('super_user.peminjaman.index', compact('peminjaman', 'barang', 'siswa'));
    }

    // Menyimpan data peminjaman barang
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'siswa_id' => 'required',
            'br_kode' => 'required',
            'pb_tgl' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {
            // Generate ID Peminjaman
            $pb_id = Peminjaman::generatePbId();

            // Simpan data peminjaman
            $peminjaman = Peminjaman::create([
                'pb_id' => $pb_id,
                'siswa_id' => $request->siswa_id,
                'pb_tgl' => $request->pb_tgl,
                'pb_stat' => 'Dipinjam', // Status peminjaman
            ]);

            // Periksa apakah barang ada dan belum dipinjam
            $barang = BarangInventaris::where('br_kode', $request->br_kode)->first();
            if ($barang && $barang->br_status === 'Ada') {
                // Simpan peminjaman barang terkait
                $peminjaman->peminjamanBarang()->create([
                    'br_kode' => $request->br_kode,
                    'pdb_sts' => 1, // Status barang: 1 berarti sedang dipinjam
                ]);

                // Update status barang menjadi dipinjam
                $barang->update(['br_status' => 'Dipinjam']);
            } else {
                throw new \Exception("Barang tidak tersedia untuk dipinjam.");
            }
        });

        return redirect()->route('super_user.peminjaman.index')->with('success', 'Peminjaman berhasil diproses.');
    }
}
