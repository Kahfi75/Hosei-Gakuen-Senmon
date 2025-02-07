<?php

namespace App\Http\Controllers;

use App\Models\BarangInventaris;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class SuperUserController extends Controller
{
    // Menampilkan halaman dashboard dengan statistik
    public function index()
    {
        // Hitung total barang
        $jumlahBarang = BarangInventaris::count();

        // Hitung total peminjaman
        $jumlahPeminjaman = Peminjaman::count();

        // Hitung jumlah peminjaman per bulan
        $peminjamanPerBulan = Peminjaman::selectRaw('MONTH(pb_tgl) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        // Siapkan data grafik (default 0 jika bulan tidak ada data)
        $dataGrafik = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataGrafik[$i] = $peminjamanPerBulan[$i] ?? 0;
        }

        // Kirim data ke view
        return view('super_user.dashboard', compact('jumlahBarang', 'jumlahPeminjaman', 'dataGrafik'));
    }

    // Halaman khusus Super User
    public function su()
    {
        return view('layout.su');
    }

    // Fungsi untuk menampilkan form pengembalian barang
    public function showFormPengembalian()
    {
        // Ambil semua barang dari database
        $barang = BarangInventaris::all();

        // Kirimkan data barang ke view
        return view('super_user.peminjaman.form_pengembalian', compact('barang'));
    }

    // Menampilkan profil Super User
    public function profil()
    {
        // $user = auth()->user(); // Mengambil data user yang sedang login
        return view('super_user.profil', compact('user'));
    }
}
