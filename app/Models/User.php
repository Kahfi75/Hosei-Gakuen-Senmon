<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user_nama' => 'required',
            'user_pass' => 'required',
        ]);

        // Ambil user berdasarkan username
        $user = User::where('user_nama', $request->user_nama)->first();

        if ($user && Hash::check($request->user_pass, $user->user_pass)) {
            session([
                'user_id' => $user->user_id,
                'user_nama' => $user->user_nama,
                'user_hak' => $user->user_hak,
            ]);

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['user_nama' => 'Username atau password salah']);
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
