<?php
namespace App\Http\Controllers;

use App\Models\BarangInventaris;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class   BarangInventarisController extends Controller
{
    // Display the dashboard and inventory items
    public function index()
    {
        $jenisBarang = JenisBarang::all(); // Get all item categories
        $penerimaan = BarangInventaris::all(); // Get all inventory items

        return view('superuser.dashboard', compact('jenisBarang', 'penerimaan'));
    }

    // Store a new inventory item
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|exists:tr_jenis_barang,jns_brg_kode',
        ]);

    
        // 'INV202500001';
        // 'INV202500002';
        // 'INV202500003';

        BarangInventaris::create([
            'br_kode' => Str::random(12),
            'br_nama' => $request->nama,
            'br_kategori' => $request->kategori,
            'br_status' => 'Received', // default status can be 'Received'
            'br_tgl_terima' => now(), // automatically set the current date
        ]);

        return redirect()->back()->with('success', 'Barang berhasil diterima!');
    }

    // Delete an inventory item
    public function destroy($kode)
    {
        $barang = BarangInventaris::findOrFail($kode);
        $barang->delete();

        return redirect()->route('super_user.baranginventaris.index')->with('success', 'Barang berhasil dihapus!');
    }
}
