<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'nama_pelaku' => 'required|string|max:255',
            'kelas_pelaku' => 'required|string|max:255',
            'jurusan_pelaku' => 'required|string|max:255',
            'anonim' => 'required|boolean',
            'nama_pelapor' => 'nullable|string|max:255',
            'kelas_pelapor' => 'nullable|string|max:255',
            'jurusan_pelapor' => 'nullable|string|max:255',
            'peran' => 'required|in:saksi,korban',
        ]);

        $report = new Report($validated);
        $report->user_id = Auth::id(); // nyambungin ke user yg login
        $report->save();

        return redirect()->back()->with('success', 'Laporan berhasil dikirim.');
    }
}
