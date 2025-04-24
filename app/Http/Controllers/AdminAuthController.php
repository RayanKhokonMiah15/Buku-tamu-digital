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

        // Cari admin berdasarkan username dari input
        $admin = Admin::where('username', $credentials['username'])->first();

        // Kalau admin ketemu dan password cocok sama yang di-hash di DB
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            // Simpan info login admin di session (kayak bikin status "lagi login")
            session(['admin_logged_in' => true]);

            // Arahkan ke route dashboard admin
            return redirect()->route('admin.dashboard');
        }

        // Kalau login gagal (admin gak ketemu atau password salah),
        // balik ke halaman login dengan pesan error
        return back()->withErrors([
            'username' => 'Username atau password salah.', // pesan ditampilkan di view
        ]);
    }

    // Fungsi buat logout admin
    public function logout()
    {
        // Hapus session 'admin_logged_in' biar status login ilang
        session()->forget('admin_logged_in');

        // Arahkan balik ke halaman login admin
        return redirect()->route('admin.login');
    }
}
