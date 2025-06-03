<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guru;

class AkunGuruController extends Controller
{
    public function showLoginForm()
    {
        return view('guru.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Debugging: Uncomment to see what's being submitted
        // dd($request->only('username', 'password'));

        if (Auth::guard('guru')->attempt([
            'username' => $request->username,
            'password' => $request->password
        ])) {
            $request->session()->regenerate();
            return redirect()->intended(route('guru.dashboard'));
        }

        return back()
            ->withErrors(['error' => 'Username atau password salah'])
            ->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Auth::guard('guru')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('guru.login.form');
    }

    public function dashboard()
    {
        return view('guru.dashboard', [
            'guru' => Auth::guard('guru')->user()
        ]);
    }
}
