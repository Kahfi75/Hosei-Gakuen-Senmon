<?php

namespace App\Http\Controllers;

use App\Models\BarangInventaris;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaanBarangController extends Controller
{
    // Menampilkan halaman penerimaan barang
    public function penerimaan()
    {
        // Mengambil data jenis barang dan data penerimaan barang
        $jenisBarang = JenisBarang::all();
        $penerimaan = BarangInventaris::with('jenisBarang')->get(); // Mengambil relasi jenis barang

        // Menampilkan view penerimaan dengan data yang diperlukan
        return view('super_user.baranginventaris.penerimaan', compact('jenisBarang', 'penerimaan'));
    }

    // Menyimpan data barang yang diterima
    public function store(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|exists:tr_jenis_barang,jns_brg_kode', // Memastikan kategori valid
        ]);

        // Mendapatkan tahun saat ini
        $tahun = date('Y');

        // Mencari nomor urut terakhir berdasarkan tahun yang sama
        $lastKode = DB::table('tm_barang_inventaris')
            ->select(DB::raw('IFNULL(MAX(CAST(SUBSTRING(br_kode, 8, 5) AS UNSIGNED)), 0) + 1 as next_urut'))
            ->whereRaw("SUBSTRING(br_kode, 4, 4) = ?", [$tahun]) // Membatasi pencarian berdasarkan tahun
            ->first();

        // Jika nomor urut tidak ditemukan (misalnya data pertama), mulai dengan 1
        $nextUrut = $lastKode->next_urut ?: 1;

        // Format kode barang: INV + Tahun + Nomor Urut (5 digit)
        $kodeBarang = 'INV' . $tahun . str_pad($nextUrut, 5, '0', STR_PAD_LEFT);

        // Menyimpan data barang inventaris yang diterima
        BarangInventaris::create([
            'br_kode' => $kodeBarang, // Menyimpan kode barang dengan format yang benar
            'jns_brg_kode' => $request->kategori, // Menyimpan kategori barang
            'br_nama' => $request->nama, // Menyimpan nama barang
            'br_tgl_terima' => now(), // Menyimpan tanggal penerimaan barang
            'br_tgl_entry' => now(), // Menyimpan tanggal entri data
            'br_status' => 'Ada', // Status barang
        ]);

        // Redirect ke halaman penerimaan dengan pesan sukses
        return redirect()->route('super_user.baranginventaris.penerimaan')
            ->with('success', 'Barang berhasil diterima dengan kode: ' . $kodeBarang);
    }

    // Menghapus data barang inventaris berdasarkan kode
    public function destroy($br_kode)
    {
        try {
            // Mencari barang berdasarkan kode
            $barang = BarangInventaris::where('br_kode', $br_kode)->first();

            // Jika barang tidak ditemukan
            if (!$barang) {
                return back()->with('error', 'Barang tidak ditemukan.');
            }

            // Menghapus barang
            $barang->delete();

            // Redirect kembali dengan pesan sukses
            return back()->with('success', 'Barang berhasil dihapus.');
        } catch (\Exception $e) {
            // Menangani error dan memberikan pesan jika terjadi kesalahan
            return back()->with('error', 'Terjadi kesalahan saat menghapus barang.');
        }
    }
}
