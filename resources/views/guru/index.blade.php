@extends('admin.layout')

@section('content')
    <h2 class="mb-4">Daftar Guru</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('guru.create') }}" class="btn btn-primary mb-3">Tambah Guru</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gurus as $guru)
                <tr>
                    <td>{{ $guru->id_guru }}</td>
                    <td>{{ $guru->username }}</td>
                    <td>{{ $guru->password }}</td>
                    <td>
                        <a href="{{ route('guru.edit', $guru->id_guru) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('guru.destroy', $guru->id_guru) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus guru ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
