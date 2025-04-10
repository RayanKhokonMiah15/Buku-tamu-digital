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
            'is_anonymous' => 'required|boolean',
            'reporter_name' => 'nullable|string|max:255',
            'reporter_class' => 'nullable|string|max:255',
            'reporter_major' => 'nullable|string|max:255',
            'peran' => 'required|in:saksi,korban',
        ]);

        $report = new Report($validated);
        $report->user_id = Auth::id(); // relasi ke user login
        $report->save();

        return redirect()->back()->with('success', 'Laporan berhasil dikirim.');
    }

    public function edit(Report $report)
    {
        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        // validasi & update logic di sini
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->back()->with('success', 'Laporan berhasil dihapus.');
    }
}
