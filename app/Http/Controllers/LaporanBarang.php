<?php

namespace App\Http\Controllers;

use App\Models\BarangInventaris;
use App\Models\JenisBarang;
use Illuminate\Http\Request;

class LaporanBarang extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data jenis barang untuk dropdown
        $jenisBarangs = JenisBarang::all();

        // Menyaring berdasarkan jenis barang atau periode
        $query = BarangInventaris::query();

        // Filter berdasarkan jenis barang jika ada
        if ($request->has('jns_brg') && $request->jns_brg != '') {
            $query->where('jns_brg_kode', $request->jns_brg);
        }

        // Filter berdasarkan periode jika ada
        if ($request->has('periode') && $request->periode != '') {
            $query->whereYear('br_tgl_terima', '=', substr($request->periode, 0, 4))
                  ->whereMonth('br_tgl_terima', '=', substr($request->periode, 5, 2));
        }

        // Ambil data barang yang sudah difilter
        $barangInventaris = $query->get();

        // Pesan jika tidak ada data
        $message = $barangInventaris->isEmpty() ? 'Tidak ada barang sesuai kriteria.' : '';

        // Kirim data ke view
        return view('super_user.laporan.LaporanBarang', compact('barangInventaris', 'jenisBarangs', 'message'));
    }

    public function pengembalian()
{
    return view('super_user.laporan.LaporanPengembalian');
}

}
