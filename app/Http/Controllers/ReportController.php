<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// Controller buat handle laporan (buat, edit, update, hapus)
class ReportController extends Controller
{
    // Fungsi buat nyimpan laporan baru dari user
    public function store(Request $request)
    {
        // Validasi input dari form laporan
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'nama_pelaku' => 'required|string|max:255',
            'kelas_pelaku' => 'required|string|max:255',
            'jurusan_pelaku' => 'required|string|max:255',
            'is_anonymous' => 'required|boolean',
            'reporter_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
            'reporter_class' => 'nullable|string|max:255',
            'reporter_major' => 'nullable|string|max:255',
            'peran' => 'required|in:saksi,korban', // harus pilih saksi atau korban
        ]);

        // Handle upload gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Ensure directory exists
            Storage::makeDirectory('public/images');

            // Store the image
            $image->storeAs('public/images', $imageName);
            $validated['image_path'] = 'images/' . $imageName;
        }

        // Buat objek laporan baru
        $report = new Report($validated);
        $report->user_id = Auth::id();
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
        // Validasi data
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($report->image_path) {
                Storage::delete('public/' . $report->image_path);
            }

            // Ensure directory exists
            Storage::makeDirectory('public/images');

            // Store new image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            $validated['image_path'] = 'images/' . $imageName;
        }

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
        // Delete image file if exists
        if ($report->image_path) {
            Storage::delete('public/' . $report->image_path);
        }

        // Hapus data laporan dari database
        $report->delete();

        // Balik ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Laporan berhasil dihapus.');
    }
}
