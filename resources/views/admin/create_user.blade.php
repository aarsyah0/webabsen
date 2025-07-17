@extends('admin.layout')
@section('content')
    <h1 class="mb-4">Tambah User</h1>
    <form action="{{ route('admin.store_user') }}" method="POST" class="card p-4 shadow-sm" style="max-width:500px;">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="siswa">Siswa</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary ms-2">Batal</a>
    </form>
@endsection
