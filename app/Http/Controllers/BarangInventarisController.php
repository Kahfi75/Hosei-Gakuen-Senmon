<?php

namespace App\Http\Controllers;

use App\Models\BarangInventaris;
use App\Models\JenisBarang;
use Illuminate\Http\Request;

class BarangInventarisController extends Controller
{
    // Menampilkan halaman penerimaan barang
    public function penerimaanBarang()
    {
        // Mengambil data barang dan jenis barang
        $barang = BarangInventaris::with('jenisBarang')->get();
        $jenisBarang = JenisBarang::all();

        // Menghitung jumlah barang berdasarkan status "Ada"
        $jumlahBarang = BarangInventaris::where('br_status', 'Ada')->count();  // Menghitung jumlah barang yang ada

        // Mengirim data barang, jenis barang dan jumlah barang ke view
        return view('super_user.baranginventaris.penerimaan', compact('barang', 'jenisBarang', 'jumlahBarang'));
    }

    // Fungsi untuk menyimpan barang yang diterima (create)
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|exists:tr_jenis_barang,jns_brg_kode',
        ]);

        try {
            // Generate kode barang
            $br_kode = $this->generateKodeBarang();

            // Simpan barang baru ke database
            BarangInventaris::create([
                'br_kode' => $br_kode,
                'br_nama' => $request->nama,
                'jns_brg_kode' => $request->kategori,
                'br_tgl_terima' => now(),
                'br_tgl_entry' => now(),
                'br_status' => 'Ada', // Default status
            ]);

            // Redirect ke halaman daftar barang setelah berhasil
            return redirect()->route('super_user.baranginventaris.index')->with('success', 'Barang berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menambahkan barang. Silakan coba lagi.'])->withInput();
        }
    }

    // Fungsi untuk memperbarui barang yang sudah ada
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

            // Redirect ke halaman daftar barang setelah berhasil
            return redirect()->route('super_user.baranginventaris.index')->with('success', 'Barang berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui barang. Silakan coba lagi.'])->withInput();
        }
    }

    // Fungsi untuk generate kode barang otomatis
    private function generateKodeBarang()
    {
        $tahun = now()->format('Y');

        // Cek nomor urut terakhir
        $no_urut = BarangInventaris::whereRaw("SUBSTRING(br_kode, 4, 4) = ?", [$tahun])
            ->selectRaw("IFNULL(MAX(CAST(SUBSTRING(br_kode, 8, 5) AS UNSIGNED)), 0) + 1 as next_urut")
            ->value('next_urut');

        // Format nomor urut jadi 5 digit
        $no_urut_padded = str_pad($no_urut, 5, '0', STR_PAD_LEFT);

        return "INV{$tahun}{$no_urut_padded}";
    }

    // Fungsi untuk menampilkan form edit barang
    public function edit($br_kode)
    {
        // Cari barang berdasarkan kode
        $barangInventaris = BarangInventaris::where('br_kode', $br_kode)->firstOrFail();
    
        // Ambil semua jenis barang
        $jenisBarang = JenisBarang::all();
    
        // Kirimkan variabel $barangInventaris dan $jenisBarang ke view
        return view('super_user.baranginventaris.edit', compact('barangInventaris', 'jenisBarang'));
    }
}
