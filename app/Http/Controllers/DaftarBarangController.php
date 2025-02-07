<?php

namespace App\Http\Controllers;

use App\Models\BarangInventaris;
use App\Models\JenisBarang;
use Illuminate\Http\Request;

class DaftarBarangController extends Controller
{
    // Menampilkan daftar barang inventaris
    public function index(Request $request)
    {
        // Menangani pencarian berdasarkan nama barang
        $search = $request->get('search');
        
        // Mengambil barang inventaris beserta jenis barang, dengan pencarian nama barang dan paginasi
        $barangInventaris = BarangInventaris::with('jenisBarang')
            ->when($search, function($query) use ($search) {
                $query->where('br_nama', 'like', '%' . $search . '%');
            })
            ->paginate(10); // Menambahkan paginasi 10 data per halaman
        
        // Mengirimkan variabel $barangInventaris dan search ke view
        return view('super_user.baranginventaris.daftar', compact('barangInventaris', 'search'));
    }

    // Menampilkan halaman edit barang
    public function edit($br_kode)
    {
        // Cari barang berdasarkan kode barang
        $barang = BarangInventaris::where('br_kode', $br_kode)->firstOrFail();
        // Ambil data jenis barang untuk dropdown
        $jenisBarang = JenisBarang::all();

        // Kirim data barang dan jenis barang ke view
        return view('super_user.baranginventaris.edit', compact('barang', 'jenisBarang'));
    }

    // Menyimpan perubahan barang yang diedit
    public function update(Request $request, $br_kode)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|exists:tr_jenis_barang,jns_brg_kode',
            'status' => 'nullable|string|max:50', // Status boleh kosong
        ]);

        try {
            // Cari barang berdasarkan kode
            $barang = BarangInventaris::where('br_kode', $br_kode)->firstOrFail();

            // Update data barang
            $barang->update([
                'br_nama' => $request->nama,
                'jns_brg_kode' => $request->kategori,
                'br_status' => $request->status ?? $barang->br_status, // Jika status tidak ada di form, biarkan tidak berubah
            ]);

            return redirect()->route('super_user.baranginventaris.index')->with('success', 'Barang berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui barang. Silakan coba lagi.'])->withInput();
        }
    }

    // Menghapus barang berdasarkan kode barang
    public function destroy($br_kode)
    {
        // Cari barang berdasarkan kode
        $barang = BarangInventaris::where('br_kode', $br_kode)->firstOrFail();

        try {
            // Hapus barang
            $barang->delete();
            return redirect()->route('super_user.baranginventaris.index')->with('success', 'Barang berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus barang. Silakan coba lagi.']);
        }
    }
}
