<?php

namespace App\Http\Controllers;

use App\Models\BarangInventaris;
use App\Models\Peminjaman;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Ambil semua barang yang tersedia dan belum dipinjam
        $barang = BarangInventaris::where('br_status', 'Ada') // Only available items
            ->whereNotIn('br_kode', Peminjaman::pluck('br_kode')) // Exclude items that are already borrowed
            ->get();

        // Ambil data peminjaman dengan relasi ke barang dan siswa
        $peminjaman = Peminjaman::with(['barang:id,br_kode,br_nama', 'siswa:id,siswa_id,nama_siswa,nisn'])
            ->select('pb_id', 'siswa_id', 'br_kode', 'pb_tgl', 'pb_stat')
            ->get();

        // Ambil semua siswa
        $siswa = Siswa::select('siswa_id', 'nama_siswa', 'nisn')->get();

        return view('super_user.peminjaman.index', compact('peminjaman', 'siswa', 'barang'));
    }

    // Menyimpan data peminjaman
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'siswa_id' => 'required|exists:siswa,siswa_id', 
            'br_kode' => 'required|exists:tm_barang_inventaris,br_kode', 
            'pb_tgl' => 'required|date',
        ]);

        DB::beginTransaction(); // Mulai transaksi
        try {
            // Cek apakah barang masih tersedia
            $barang = BarangInventaris::where('br_kode', $request->br_kode)->first();

            if (!$barang || $barang->br_status !== 'Ada') {
                return back()->withErrors(['error' => 'Barang tidak tersedia atau sudah dipinjam.'])->withInput();
            }

            // Simpan data peminjaman
            $peminjaman = Peminjaman::create([
                'siswa_id' => $request->siswa_id,
                'br_kode' => $request->br_kode, // Pastikan kolom ini terisi
                'pb_tgl' => $request->pb_tgl,
                'pb_stat' => 'Dipinjam', // Status default
            ]);

            // Update status barang menjadi 'Dipinjam'
            $barang->update(['br_status' => 'Dipinjam']);

            DB::commit(); // Simpan transaksi

            return redirect()->route('super_user.peminjaman.index')->with('success', 'Peminjaman berhasil dilakukan.');
        } catch (\Throwable $e) {
            DB::rollBack(); // Batalkan transaksi jika terjadi kesalahan

            return back()->withErrors(['error' => 'Gagal melakukan peminjaman: ' . $e->getMessage()])->withInput();
        }
    }

    // Menampilkan detail peminjaman
    public function show($id)
    {
        // Cari peminjaman berdasarkan id dengan relasi barang dan siswa
        $peminjaman = Peminjaman::with(['barang', 'siswa'])->findOrFail($id);

        return view('super_user.peminjaman.show', compact('peminjaman'));
    }
}
