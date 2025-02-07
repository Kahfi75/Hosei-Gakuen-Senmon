<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangInventaris;

class PenerimaanController extends Controller
{
    // Menampilkan form penerimaan barang
    public function penerimaan()
    {
        return view('super_user.baranginventaris.penerimaan');
    }

    // Menyimpan data penerimaan barang
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal_penerimaan' => 'required|date',
        ]);

        // Simpan data penerimaan barang
        BarangInventaris::create([
            'nama_barang' => $validated['nama_barang'],
            'jumlah' => $validated['jumlah'],
            'tanggal_penerimaan' => $validated['tanggal_penerimaan'],
        ]);

        return redirect()->route('barang_inventaris.index')
                         ->with('success', 'Penerimaan barang berhasil disimpan!');
    }
}
