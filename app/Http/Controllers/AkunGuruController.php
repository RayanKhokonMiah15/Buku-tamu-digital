<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guru;
use App\Models\Report;

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

        if (
            Auth::guard('guru')->attempt([
                'username' => $request->username,
                'password' => $request->password
            ])
        ) {
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
        $guru = Auth::guard('guru')->user();

        // Get all reports with relationships loaded
        // Get all reports with relationships loaded and ordered by status and creation time
        $reports = Report::with(['user', 'guru', 'handlingGuru'])
            ->orderByRaw("CASE
                WHEN status = 'pending' THEN 1
                WHEN status = 'proses' THEN 2
                WHEN status = 'selesai' THEN 3
                END")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('guru.dashboard', [
            'guru' => $guru,
            'reports' => $reports
        ]);
    }
}
