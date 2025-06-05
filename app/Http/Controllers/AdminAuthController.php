<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

// Controller buat handle login/logout khusus admin
class AdminAuthController extends Controller
{
    // Fungsi buat nampilin form login admin (halaman login)
    public function showLoginForm()
    {
        // Balikin view dari resources/views/admin/login.blade.php
        return view('admin.login');
    }

    // Fungsi buat proses login admin setelah form dikirim
    public function login(Request $request)
    {
        // Validasi data input dari form: harus isi username & password
        $credentials = $request->validate([
            'username' => 'required',  // wajib isi username
            'password' => 'required'   // wajib isi password
        ]);

        // Attempt to login using admin guard
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        // Kalau login gagal (admin gak ketemu atau password salah),
        // balik ke halaman login dengan pesan error
        return back()->withErrors([
            'username' => 'Username atau password salah.', // pesan ditampilkan di view
        ]);
    }

    // Fungsi buat logout admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
