@extends('admin.layout')
@section('content')
    <h1 class="mb-4">Edit User</h1>
    <form action="{{ route('admin.update_user', $user->id) }}" method="POST" class="card p-4 shadow-sm" style="max-width:500px;">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary ms-2">Batal</a>
    </form>
@endsection
