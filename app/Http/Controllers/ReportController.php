<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Menyimpan laporan baru yang dibuat oleh pengguna.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:5120', // Maks 5MB
            'nama_pelaku' => 'required_unless:unknown_perpetrator,1|string|max:255',
            'kelas_pelaku' => 'required_unless:unknown_perpetrator,1|string|max:255',
            'jurusan_pelaku' => 'required_unless:unknown_perpetrator,1|string|max:255',
            'peran' => 'required|in:saksi,korban',
            'is_anonymous' => 'boolean',
            'reporter_name' => 'nullable|string|max:255',
            'reporter_class' => 'nullable|string|max:255',
            'reporter_major' => 'nullable|string|max:255',
            'unknown_perpetrator' => 'boolean',
        ], [
            'judul.required' => 'Judul laporan wajib diisi.',
            'isi_laporan.required' => 'Isi laporan wajib diisi.',
            'image.image' => 'File harus berupa gambar (JPG, PNG, atau GIF).',
            'image.max' => 'Ukuran gambar maksimal 5MB.',
            'nama_pelaku.required_unless' => 'Nama pelaku wajib diisi jika pelaku diketahui.',
            'kelas_pelaku.required_unless' => 'Kelas pelaku wajib diisi jika pelaku diketahui.',
            'jurusan_pelaku.required_unless' => 'Jurusan pelaku wajib diisi jika pelaku diketahui.',
            'peran.required' => 'Peran wajib dipilih.',
            'peran.in' => 'Peran harus berupa saksi atau korban.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        // Tangani upload gambar jika ada
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                Storage::makeDirectory('public/images');
                $image->storeAs('public/images', $imageName);
                $validated['image_path'] = 'images/' . $imageName;
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Gagal mengunggah gambar: ' . $e->getMessage()])->withInput();
            }
        }

        // Tangani pelaku tidak diketahui
        if ($request->has('unknown_perpetrator') && $request->unknown_perpetrator) {
            $validated['nama_pelaku'] = 'Tidak Diketahui';
            $validated['kelas_pelaku'] = 'Tidak Diketahui';
            $validated['jurusan_pelaku'] = 'Tidak Diketahui';
        }

        // Tangani laporan anonim
        $validated['is_anonymous'] = $request->has('is_anonymous') && $request->is_anonymous;
        if ($validated['is_anonymous']) {
            $validated['reporter_name'] = null;
            $validated['reporter_class'] = null;
            $validated['reporter_major'] = null;
        }

        try {
            $report = new Report($validated);

            // Set ID berdasarkan pengguna yang membuat laporan
            if (Auth::guard('guru')->check()) {
                $report->guru_id = Auth::guard('guru')->id();
            } else {
                $report->user_id = Auth::id();
            }

            $report->save();

            return redirect()->back()->with('success', 'Laporan berhasil dikirim.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan laporan: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Menampilkan form untuk mengedit laporan.
     *
     * @param Report $report
     * @return \Illuminate\View\View
     */
    public function edit(Report $report)
    {
        // Periksa kepemilikan laporan
        if (Auth::guard('guru')->check()) {
            if ($report->guru_id !== Auth::guard('guru')->id()) {
                abort(403, 'Anda tidak memiliki izin untuk mengedit laporan ini.');
            }
        } else {
            if ($report->user_id !== Auth::id()) {
                abort(403, 'Anda tidak memiliki izin untuk mengedit laporan ini.');
            }
        }

        return view('reports.edit', compact('report'));
    }

    /**
     * Memperbarui laporan yang sudah ada.
     *
     * @param Request $request
     * @param Report $report
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Report $report)
    {
        // Periksa kepemilikan laporan
        if (Auth::guard('guru')->check()) {
            if ($report->guru_id !== Auth::guard('guru')->id()) {
                abort(403, 'Anda tidak memiliki izin untuk mengedit laporan ini.');
            }
        } else {
            if ($report->user_id !== Auth::id()) {
                abort(403, 'Anda tidak memiliki izin untuk mengedit laporan ini.');
            }
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:5120', // Maks 5MB
            'nama_pelaku' => 'required_unless:unknown_perpetrator,1|string|max:255',
            'kelas_pelaku' => 'required_unless:unknown_perpetrator,1|string|max:255',
            'jurusan_pelaku' => 'required_unless:unknown_perpetrator,1|string|max:255',
            'peran' => 'required|in:saksi,korban',
            'is_anonymous' => 'boolean',
            'reporter_name' => 'nullable|string|max:255',
            'reporter_class' => 'nullable|string|max:255',
            'reporter_major' => 'nullable|string|max:255',
            'unknown_perpetrator' => 'boolean',
        ], [
            'judul.required' => 'Judul laporan wajib diisi.',
            'isi_laporan.required' => 'Isi laporan wajib diisi.',
            'image.image' => 'File harus berupa gambar (JPG, PNG, atau GIF).',
            'image.max' => 'Ukuran gambar maksimal 5MB.',
            'nama_pelaku.required_unless' => 'Nama pelaku wajib diisi jika pelaku diketahui.',
            'kelas_pelaku.required_unless' => 'Kelas pelaku wajib diisi jika pelaku diketahui.',
            'jurusan_pelaku.required_unless' => 'Jurusan pelaku wajib diisi jika pelaku diketahui.',
            'peran.required' => 'Peran wajib dipilih.',
            'peran.in' => 'Peran harus berupa saksi atau korban.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        try {
            // Tangani pembaruan gambar
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($report->image_path) {
                    Storage::delete('public/' . $report->image_path);
                }

                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/images', $imageName);
                $validated['image_path'] = 'images/' . $imageName;
            }

            // Tangani pelaku tidak diketahui
            if ($request->has('unknown_perpetrator') && $request->unknown_perpetrator) {
                $validated['nama_pelaku'] = 'Tidak Diketahui';
                $validated['kelas_pelaku'] = 'Tidak Diketahui';
                $validated['jurusan_pelaku'] = 'Tidak Diketahui';
            }

            // Tangani laporan anonim
            $validated['is_anonymous'] = $request->has('is_anonymous') && $request->is_anonymous;
            if ($validated['is_anonymous']) {
                $validated['reporter_name'] = null;
                $validated['reporter_class'] = null;
                $validated['reporter_major'] = null;
            }

            $report->update($validated);

            $redirectRoute = Auth::guard('guru')->check() ? 'guru.dashboard' : 'dashboard';
            return redirect()->route($redirectRoute)->with('success', 'Laporan berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui laporan: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Menghapus laporan.
     *
     * @param Report $report
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Report $report)
    {
        // Periksa kepemilikan laporan
        if (Auth::guard('guru')->check()) {
            if ($report->guru_id !== Auth::guard('guru')->id()) {
                abort(403, 'Anda tidak memiliki izin untuk menghapus laporan ini.');
            }
        } else {
            if ($report->user_id !== Auth::id()) {
                abort(403, 'Anda tidak memiliki izin untuk menghapus laporan ini.');
            }
        }

        try {
            // Hapus gambar jika ada
            if ($report->image_path) {
                Storage::delete('public/' . $report->image_path);
            }

            $report->delete();
            return redirect()->back()->with('success', 'Laporan berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus laporan: ' . $e->getMessage()]);
        }
    }

    /**
     * Menangani laporan oleh guru.
     *
     * @param Report $report
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleReport(Report $report)
    {
        if ($report->handled_by_guru_id !== null) {
            return back()->withErrors(['error' => 'Laporan ini sudah ditangani oleh guru lain.']);
        }

        try {
            $report->handled_by_guru_id = Auth::guard('guru')->id();
            $report->status = 'proses';
            $report->save();
            return back()->with('success', 'Anda sekarang menangani laporan ini.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menangani laporan: ' . $e->getMessage()]);
        }
    }

    /**
     * Memperbarui status laporan.
     *
     * @param Request $request
     * @param Report $report
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, Report $report)
    {
        if ($report->handled_by_guru_id !== Auth::guard('guru')->id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah status laporan ini.');
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,proses,selesai',
        ], [
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status harus berupa pending, proses, atau selesai.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        try {
            $report->update($validator->validated());
            return back()->with('success', 'Status laporan berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui status: ' . $e->getMessage()]);
        }
    }

    /**
     * Menampilkan detail laporan.
     *
     * @param Report $report
     * @return \Illuminate\View\View
     */
    public function show(Report $report)
    {
        // Periksa kepemilikan laporan
        if (Auth::guard('guru')->check()) {
            if ($report->guru_id !== Auth::guard('guru')->id()) {
                abort(403, 'Anda tidak memiliki izin untuk melihat laporan ini.');
            }
        } else {
            if ($report->user_id !== Auth::id()) {
                abort(403, 'Anda tidak memiliki izin untuk melihat laporan ini.');
            }
        }

        $report->load(['handlingGuru', 'user', 'guru']);
        return view('reports.show', compact('report'));
    }
}
