<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::all();
        return view('guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:gurus',
            'password' => 'required|min:6',
        ]);

        Guru::create([
            'username' => $request->username,
            'password' => $request->password, // Will be hashed by the model
        ]);

        return redirect()->route('guru.index')
            ->with('success', 'Guru berhasil ditambahkan');
    }

    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'username' => 'required|unique:gurus,username,' . $guru->id_guru . ',id_guru',
            'password' => 'nullable|min:6',
        ]);

        $guru->username = $request->username;
        if ($request->filled('password')) {
            $guru->password = $request->password;
        }
        $guru->save();

        return redirect()->route('guru.index')
            ->with('success', 'Guru berhasil diupdate');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        return redirect()->route('guru.index')
            ->with('success', 'Guru berhasil dihapus');
    }
}
