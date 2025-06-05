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

            // Set the appropriate ID based on who's creating the report
            if (Auth::guard('guru')->check()) {
                $report->guru_id = Auth::guard('guru')->id();
            } else {
                $report->user_id = Auth::id();
            }

            $report->save();

            return redirect()->back()->with('success', 'Laporan berhasil dikirim.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan laporan. Silakan coba lagi.']);
        }
    }

    // Fungsi buat nampilin form edit laporan
    public function edit(Report $report)
    {
        // Check if the authenticated user owns this report
        if (Auth::guard('guru')->check()) {
            if ($report->guru_id !== Auth::guard('guru')->id()) {
                abort(403);
            }
        } else {
            if ($report->user_id !== Auth::id()) {
                abort(403);
            }
        }

        // Tampilkan view edit dan lempar data laporan ke view
        return view('reports.edit', compact('report'));
    }

    // Fungsi buat update laporan setelah diedit
    public function update(ReportRequest $request, Report $report)
    {
        // Check ownership
        if (Auth::guard('guru')->check()) {
            if ($report->guru_id !== Auth::guard('guru')->id()) {
                abort(403);
            }
        } else {
            if ($report->user_id !== Auth::id()) {
                abort(403);
            }
        }

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

            $redirectRoute = Auth::guard('guru')->check() ? 'guru.dashboard' : 'dashboard';
            return redirect()->route($redirectRoute)->with('success', 'Laporan berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui laporan. Silakan coba lagi.']);
        }
    }

    // Fungsi buat hapus laporan
    public function destroy(Report $report)
    {
        // Check ownership
        if (Auth::guard('guru')->check()) {
            if ($report->guru_id !== Auth::guard('guru')->id()) {
                abort(403);
            }
        } else {
            if ($report->user_id !== Auth::id()) {
                abort(403);
            }
        }

        // Delete image file if exists
        if ($report->image_path) {
            Storage::delete('public/' . $report->image_path);
        }

        // Hapus data laporan dari database
        $report->delete();

        // Balik ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Laporan berhasil dihapus.');
    }

    public function handleReport(Report $report)
    {
        // Check if report is already handled
        if ($report->handled_by_guru_id !== null) {
            return back()->with('error', 'Laporan ini sudah ditangani oleh guru lain.');
        }

        // Set the current guru as the handler
        $report->handled_by_guru_id = Auth::guard('guru')->id();
        $report->status = 'proses'; // Automatically set status to "proses" when handled
        $report->save();

        return back()->with('success', 'Anda sekarang menangani laporan ini.');
    }

    public function updateStatus(Request $request, Report $report)
    {
        // Verify that the authenticated guru is the handler
        if ($report->handled_by_guru_id !== Auth::guard('guru')->id()) {
            abort(403, 'Anda tidak berwenang mengubah status laporan ini.');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,proses,selesai'
        ]);

        $report->update($validated);

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function show(Report $report)
    {
        // Check ownership
        if (Auth::guard('guru')->check()) {
            if ($report->guru_id !== Auth::guard('guru')->id()) {
                abort(403);
            }
        } else {
            if ($report->user_id !== Auth::id()) {
                abort(403);
            }
        }

        // Load necessary relationships
        $report->load(['handlingGuru', 'user', 'guru']);

        return view('reports.show', compact('report'));
    }
}
