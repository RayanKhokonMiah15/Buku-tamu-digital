@extends('admin.layout')

@section('content')
    <h2 class="mb-4">Edit Guru</h2>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('guru.update', $guru->id_guru) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" required value="{{ old('username', $guru->username) }}">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password (isi jika ingin ganti)</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('guru.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
