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
        $jenisBarang = JenisBarang::all();
        $penerimaan = BarangInventaris::with('jenisBarang')->get();

        return view('super_user.baranginventaris.penerimaan', compact('jenisBarang', 'penerimaan'));
    }

    // Menyimpan data barang yang diterima
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|exists:tr_jenis_barang,jns_brg_kode',
        ]);

        $tahun = date('Y');

        // Mendapatkan nomor urut terakhir berdasarkan tahun
        $lastKode = DB::table('tm_barang_inventaris')
            ->whereRaw("SUBSTRING(br_kode, 4, 4) = ?", [$tahun])
            ->orderByDesc('br_kode')
            ->pluck('br_kode')
            ->first();

        $nextUrut = $lastKode ? (intval(substr($lastKode, 8, 5)) + 1) : 1;

        // Format kode barang: INV+TAHUN+NO_URUT (5 digit)
        $kodeBarang = 'INV' . $tahun . str_pad($nextUrut, 5, '0', STR_PAD_LEFT);

        BarangInventaris::create([
            'br_kode' => $kodeBarang,
            'jns_brg_kode' => $request->kategori,
            'br_nama' => $request->nama,
            'br_tgl_terima' => now(),
            'br_tgl_entry' => now(),
            'br_status' => 'Ada',
        ]);

        return redirect()->route('super_user.baranginventaris.penerimaan')
            ->with('success', 'Barang berhasil diterima dengan kode: ' . $kodeBarang);
    }

    // Menghapus data barang inventaris berdasarkan kode
    public function destroy($br_kode)
    {
        try {
            $barang = BarangInventaris::where('br_kode', $br_kode)->first();

            if (!$barang) {
                return back()->with('error', 'Barang tidak ditemukan.');
            }

            $barang->delete();

            return back()->with('success', 'Barang berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus barang.');
        }
    }
}
