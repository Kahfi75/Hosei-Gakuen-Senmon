<?php

// app/Http/Controllers/BarangController.php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        // Menampilkan semua data barang
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        // Menampilkan form untuk menambah barang
        return view('barang.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'kode_barang' => 'required|unique:barang',
            'nama_barang' => 'required',
            'kategori' => 'required',
            'jumlah' => 'required|integer',
            'status' => 'required|in:Tersedia,Dipinjam,Rusak,Hilang',
        ]);

        // Menyimpan data barang
        Barang::create($validated);

        return redirect()->route('barang.index');
    }
}
