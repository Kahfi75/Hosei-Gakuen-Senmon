<?php

namespace App\Http\Controllers;

use App\Models\BarangInventaris;
use Illuminate\Http\Request;

class DaftarBarangController extends Controller
{
    // Menampilkan daftar barang inventaris dengan pencarian dan paginasi
    public function index(Request $request)
    {
        // Menangani pencarian berdasarkan nama barang
        $search = $request->get('search');
        
        // Mengambil barang inventaris beserta jenis barang, dengan pencarian nama barang dan paginasi
        $barangInventaris = BarangInventaris::with('jenis_barang')
            ->when($search, function($query) use ($search) {
                $query->where('br_nama', 'like', '%' . $search . '%');
            })
            ->paginate(10); // Menambahkan paginasi 10 data per halaman
        
        return view('barang_inventaris.index', compact('barangInventaris', 'search'));
    }

    // Menampilkan form untuk mengedit barang inventaris
    public function edit($id)
    {
        $barangInventaris = BarangInventaris::findOrFail($id); // Mengambil data barang inventaris berdasarkan ID
        return view('barang_inventaris.edit', compact('barangInventaris'));
    }

    // Memperbarui data barang inventaris
    public function update(Request $request, $id)
    {
        $request->validate([
            'br_nama' => 'required|string|max:255',
            'br_status' => 'required|string|max:50',
        ]);

        $barangInventaris = BarangInventaris::findOrFail($id);

        if (!$barangInventaris) {
            return redirect()->route('barang_inventaris.index')->with('error', 'Barang tidak ditemukan.');
        }

        $barangInventaris->update([
            'br_nama' => $request->br_nama,
            'br_status' => $request->br_status,
        ]);

        return redirect()->route('barang_inventaris.index')->with('success', 'Barang berhasil diperbarui.');
    }

    // Menghapus barang inventaris
    public function destroy($id)
    {
        $barangInventaris = BarangInventaris::findOrFail($id);

        if (!$barangInventaris) {
            return redirect()->route('barang_inventaris.index')->with('error', 'Barang tidak ditemukan.');
        }

        // Anda bisa menambahkan logika untuk memeriksa apakah barang sedang dipinjam atau digunakan
        // if ($barangInventaris->isUsed()) {
        //     return redirect()->route('barang_inventaris.index')->with('error', 'Barang sedang digunakan.');
        // }

        $barangInventaris->delete();

        return redirect()->route('barang_inventaris.index')->with('success', 'Barang berhasil dihapus.');
    }
}
