<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cari user berdasarkan user_id (email)
        $user = User::where('user_id', $request->email)->first();

        if ($user && Hash::check($request->password, $user->user_pass)) {
            // Set session untuk pengguna
            Session::put('user_id', $user->user_id);
            Session::put('user_nama', $user->user_nama);
            Session::put('user_hak', $user->user_hak);

            // Redirect ke halaman dashboard sesuai peran
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors(['email' => 'Email atau password salah.']);
        }
    }

    // Menangani logout
    public function logout()
    {
        Session::flush(); // Menghapus session
        return redirect()->route('login');
    }
}
