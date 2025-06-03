<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    // ini buat dashboard admin dik
    
    public function create()
    {
        return view('guru.create');
    }

    // Menampilkan daftar guru
    public function index()
    {
        $gurus = \App\Models\Guru::all();
        return view('guru.index', compact('gurus'));
    }

    // Menyimpan data admin baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:gurus,username',
            'password' => 'required|string|min:6',
        ]);
        // Jika ingin menyimpan password yang sudah di-hash, uncomment baris berikut
        // $validated['password'] = bcrypt($validated['password']);
        \App\Models\Guru::create($validated);
        return redirect()->route('guru.index')->with('success', 'Guru berhasil ditambahkan.');
    }

    // Menampilkan form edit admin
    public function edit($id)
    {
        $guru = \App\Models\Guru::findOrFail($id);
        return view('guru.edit', compact('guru'));
    }

    // Mengupdate data admin
    public function update(Request $request, $id)
    {
        $guru = \App\Models\Guru::findOrFail($id);
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:gurus,username,' . $id . ',id_guru',
            'password' => 'nullable|string|min:6',
        ]);
        if ($validated['password']) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }
        $guru->update($validated);
        return redirect()->route('guru.index')->with('success', 'Guru berhasil diupdate.');
    }

    // Menghapus data admin
    public function destroy($id)
    {
        $guru = \App\Models\Guru::findOrFail($id);
        $guru->delete();
        return redirect()->route('guru.index')->with('success', 'Guru berhasil dihapus.');
    }
    
}