<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ReportRequest;

// Controller buat handle laporan (buat, edit, update, hapus)
class ReportController extends Controller
{
    // Fungsi buat nyimpan laporan baru dari user
    public function store(ReportRequest $request)
    {
        // Get validated data
        $validated = $request->validated();

        // Handle upload gambar jika ada
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();

                // Ensure directory exists
                Storage::makeDirectory('public/images');

                // Store the image
                $image->storeAs('public/images', $imageName);
                $validated['image_path'] = 'images/' . $imageName;
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Gagal mengunggah gambar. Silakan coba lagi.']);
            }
        }

        // Handle unknown perpetrator
        if ($request->has('unknown_perpetrator') && $request->unknown_perpetrator) {
            $validated['nama_pelaku'] = 'Tidak Diketahui';
            $validated['kelas_pelaku'] = 'Tidak Diketahui';
            $validated['jurusan_pelaku'] = 'Tidak Diketahui';
        }

        // Buat objek laporan baru
        try {
            $report = new Report($validated);
            $report->user_id = Auth::id();
            $report->save();

            return redirect()->back()->with('success', 'Laporan berhasil dikirim.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan laporan. Silakan coba lagi.']);
        }
    }

    // Fungsi buat nampilin form edit laporan
    public function edit(Report $report)
    {
        // Tampilkan view edit dan lempar data laporan ke view
        return view('reports.edit', compact('report'));
    }

    // Fungsi buat update laporan setelah diedit
    public function update(ReportRequest $request, Report $report)
    {
        // Get validated data
        $validated = $request->validated();

        try {
            // Handle image update
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($report->image_path) {
                    Storage::delete('public/' . $report->image_path);
                }

                // Store new image
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/images', $imageName);
                $validated['image_path'] = 'images/' . $imageName;
            }

            // Handle unknown perpetrator
            if ($request->has('unknown_perpetrator') && $request->unknown_perpetrator) {
                $validated['nama_pelaku'] = 'Tidak Diketahui';
                $validated['kelas_pelaku'] = 'Tidak Diketahui';
                $validated['jurusan_pelaku'] = 'Tidak Diketahui';
            }

            // Handle anonymous report
            if ($request->has('is_anonymous')) {
                $validated['reporter_name'] = null;
                $validated['reporter_class'] = null;
                $validated['reporter_major'] = null;
                $validated['is_anonymous'] = true;
            } else {
                $validated['is_anonymous'] = false;
            }

            // Update report
            $report->update($validated);

            return redirect()->route('dashboard')->with('success', 'Laporan berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui laporan. Silakan coba lagi.']);
        }
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
