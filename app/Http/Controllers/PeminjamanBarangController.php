<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\PeminjamanBarang;
use App\Models\BarangInventaris;
use App\Models\Siswa;
use Illuminate\Support\Str;

class PeminjamanBarangController extends Controller
{
    /**
     * Menampilkan daftar peminjaman dan form peminjaman.
     */
    public function index()
    {
        // Mendapatkan semua data peminjaman beserta data barang dan siswa terkait
        $peminjaman = Peminjaman::with(['peminjamanBarang.barangInventaris', 'siswa'])->get();
        
        // Mendapatkan semua data siswa dan barang yang tersedia
        $siswa = Siswa::all();
        $barang = BarangInventaris::where('br_status', 'tersedia')->get();

        // Mengirim data ke view
        return view('super_user.peminjaman_barang.peminjaman', compact('peminjaman', 'siswa', 'barang'));
    }

    /**
     * Menyimpan data peminjaman barang.
     */
    public function store(Request $request)
    {
        // Validasi input form peminjaman
        $request->validate([
            'siswa_id' => 'required|exists:siswa,siswa_id',
            'br_kode' => 'required|exists:barang_inventaris,br_kode',
            'pb_tgl' => 'required|date',
        ]);

        // Membuat ID unik untuk peminjaman
        $pb_id = Str::uuid()->toString();

        // Menyimpan data peminjaman
        $peminjaman = Peminjaman::create([
            'pb_id' => $pb_id,
            'siswa_id' => $request->siswa_id,
            'pb_tgl' => $request->pb_tgl,
            'pb_harus_kembali_tgl' => now()->addDays(7), // Default 7 hari masa pinjam
            'pb_stat' => '01', // Status aktif
        ]);

        // Menyimpan data peminjaman barang
        PeminjamanBarang::create([
            'pb_id' => $pb_id,
            'br_kode' => $request->br_kode,
        ]);

        // Mengupdate status barang menjadi 'dipinjam'
        $barang = BarangInventaris::where('br_kode', $request->br_kode)->first();
        $barang->update(['br_status' => 'dipinjam']);

        // Mengarahkan kembali ke halaman daftar peminjaman dengan pesan sukses
        return redirect()->route('super_user.peminjaman.index')->with('success', 'Peminjaman berhasil disimpan.');
    }

    /**
     * Menyimpan data pengembalian barang.
     */
    public function storeReturn(Request $request)
    {
        // Validasi data pengembalian
        $validated = $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman_barang,id',
            'tanggal_kembali' => 'required|date',
        ]);

        // Menandai peminjaman sebagai sudah kembali
        $peminjaman = PeminjamanBarang::find($validated['peminjaman_id']);
        $peminjaman->status = 'Sudah Kembali';
        $peminjaman->tanggal_kembali = $validated['tanggal_kembali'];
        $peminjaman->save();

        // Update status barang menjadi tersedia
        $barang = BarangInventaris::where('br_kode', $peminjaman->br_kode)->first();
        $barang->update(['br_status' => 'tersedia']);

        return redirect()->route('super_user.peminjaman.index')->with('success', 'Pengembalian barang berhasil diproses.');
    }

    /**
     * Menampilkan form pengembalian barang.
     */
    public function returnForm()
    {
        // Mengambil data peminjaman barang yang belum dikembalikan
        $peminjamanBarang = PeminjamanBarang::whereNull('tanggal_kembali')->get();
        return view('super_user.peminjaman_barang.pengembalian', compact('peminjamanBarang'));
    }

    /**
     * Daftar barang yang belum dikembalikan.
     */
    public function barangBelumKembali()
    {
        // Ambil data peminjaman barang yang belum dikembalikan
        $peminjamanBarang = PeminjamanBarang::with(['peminjaman', 'barangInventaris'])
            ->whereNull('tanggal_kembali') // Filter yang belum dikembalikan
            ->get();

        // Kirim data ke tampilan
        return view('super_user.peminjaman_barang.BBelumKembali', compact('peminjamanBarang'));
    }
}
