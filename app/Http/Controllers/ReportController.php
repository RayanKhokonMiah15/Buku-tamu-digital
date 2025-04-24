<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Controller buat handle laporan (buat, edit, update, hapus)
class ReportController extends Controller
{
    // Fungsi buat nyimpan laporan baru dari user
    public function store(Request $request)
    {
        // Validasi input dari form laporan
        $validated = $request->validate([
            'judul' => 'required|string|max:255', // judul wajib diisi
            'isi_laporan' => 'required|string',   // isi laporan juga wajib
            'nama_pelaku' => 'required|string|max:255',
            'kelas_pelaku' => 'required|string|max:255',
            'jurusan_pelaku' => 'required|string|max:255',
            'is_anonymous' => 'required|boolean', // checkbox anonim wajib dikirim
            'reporter_name' => 'nullable|string|max:255', // boleh kosong
            'reporter_class' => 'nullable|string|max:255',
            'reporter_major' => 'nullable|string|max:255',
            'peran' => 'required|in:saksi,korban', // harus pilih saksi atau korban
        ]);

        // Buat objek laporan baru pake data yang udah divalidasi
        $report = new Report($validated);

        // Simpan ID user yang lagi login ke field user_id di laporan
        $report->user_id = Auth::id();

        // Simpan laporan ke database
        $report->save();

        // Balik ke halaman sebelumnya dengan notifikasi sukses
        return redirect()->back()->with('success', 'Laporan berhasil dikirim.');
    }

    // Fungsi buat nampilin form edit laporan
    public function edit(Report $report)
    {
        // Tampilkan view edit dan lempar data laporan ke view
        return view('reports.edit', compact('report'));
    }

    // Fungsi buat update laporan setelah diedit
    public function update(Request $request, Report $report)
    {
        // Validasi ulang data yang diedit
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'nama_pelaku' => 'nullable|string|max:255',
            'kelas_pelaku' => 'nullable|string|max:255',
            'jurusan_pelaku' => 'nullable|string|max:255',
            'peran' => 'required|in:saksi,korban',
            'is_anonymous' => 'nullable|boolean',
            'reporter_name' => 'nullable|string|max:255',
            'reporter_class' => 'nullable|string|max:255',
            'reporter_major' => 'nullable|string|max:255',
        ]);

        // Kalau user pilih "anonim", hapus info pelapor & set anonim true
        if ($request->has('is_anonymous')) {
            $validated['reporter_name'] = null;
            $validated['reporter_class'] = null;
            $validated['reporter_major'] = null;
            $validated['is_anonymous'] = true;
        } else {
            // Kalau nggak, tandain sebagai non-anonim
            $validated['is_anonymous'] = false;
        }

        // Update data laporan di database
        $report->update($validated);

        // Arahkan ke dashboard dengan notifikasi sukses
        return redirect()->route('dashboard')->with('success', 'Laporan berhasil diperbarui!');
    }

    // Fungsi buat hapus laporan
    public function destroy(Report $report)
    {
        // Hapus data laporan dari database
        $report->delete();

        // Balik ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Laporan berhasil dihapus.');
    }
}
