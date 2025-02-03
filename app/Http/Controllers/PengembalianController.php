<?php

namespace App\Http\Controllers;

use App\Models\BarangInventaris;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    // Menampilkan form untuk pengembalian barang
    public function showFormPengembalian()
    {
        // Ambil data barang yang dipinjam (status 'Dipinjam')
        $barang = BarangInventaris::where('br_status', 'Dipinjam')->get();

        // Kirimkan data barang ke view
        return view('super_user.peminjaman_barang.pengembalian', compact('barang'));
    }

    // Menyimpan pengembalian barang
    public function simpanPengembalian(Request $request)
    {
        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'barang_id' => 'required|exists:tm_barang_inventaris,br_kode', // Validasi id barang
            'kembali_tgl' => 'required|date', // Validasi tanggal kembali
        ]);

        // Membuat data pengembalian
        $pengembalian = new Pengembalian();
        // $pengembalian->kembali_id = 'KBL' . strtoupper(str_random(5)); // Membuat ID Pengembalian unik
        $pengembalian->pb_id = $request->barang_id;
        $pengembalian->user_id = Auth::id(); // ID pengguna yang mengembalikan barang
        $pengembalian->kembali_tgl = $request->kembali_tgl;
        $pengembalian->kembali_sts = 'Selesai'; // Status pengembalian, misalnya selesai

        // Simpan data pengembalian ke database
        $pengembalian->save();

        // Update status barang setelah dikembalikan
        $barang = BarangInventaris::find($request->barang_id);
        $barang->br_status = 'Tersedia'; // Status barang berubah menjadi tersedia
        $barang->save();

        // Redirect dengan pesan sukses
        return redirect()->route('super_user.peminjaman.pengembalian')
                         ->with('success', 'Barang berhasil dikembalikan');
    }
}
