<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class AdminController extends Controller
{

    /*
    * di fungsi index itu buat fungsi pertama yang akan dijalankan, kayak index.html aja, index.html file yang pertama
    * ditampilin browser kalau gak specified sebuah url lain
    *
    * kalau funsgi show buat nampilin data.
    *
    * nah fungsi edit, yaa buat edit kalau ada operasi crud
    *
    * store buat nyimpen data setelah operasi edit dilakukan, kalau ada funsgi edit tapi gak ada fungsi store, ya sarua keneh jeung bohong.
    *
    * destroy buat nge hapus data.
    *
    * gitu aja sih sebenernya. gampang. destroy = hancurkan. harus mengerti bahasa inggris
    */
    public function index()
    {
        $reports = Report::latest()->get(); // ambil semua laporan
        return view('admin.dashboard', compact('reports'));
    }

    public function updateStatus(Request $request, Report $report)
    {
        \Log::info('Updating status for report ' . $report->id . ' to ' . $request->status);

        $report->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Status berhasil diperbarui!');
    }



    public function edit(Report $report)
    {
        return view('admin.edit', compact('report'));
    }


    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Laporan berhasil dihapus!');
    }

    public function dashboard()
    {
        $reports = Report::latest()->get();
        return view('admin.dashboard', compact('reports'));
    }
}
