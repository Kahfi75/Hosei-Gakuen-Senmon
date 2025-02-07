<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan halaman dashboard admin
    public function index()
    {
        return view('admin.dashboard');
    }

    // Menampilkan profil Admin
    public function profil()
    {
        // $user = auth()->user(); // Mengambil data user yang sedang login
        return view('admin.profil', compact('user'));
    }
}
