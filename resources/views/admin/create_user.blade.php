@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold m-0">Tambah User</h1>
        <small class="text-muted">{{ now()->format('l, j F Y') }}</small>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card card-custom shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Tambah User</h5>
                    <form action="{{ route('admin.store_user') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name"
                                value="{{ old('name') }}" required placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email"
                                value="{{ old('email') }}" required placeholder="Masukkan email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password"
                                required placeholder="Masukkan password">
                        </div>
                        <div class="mb-3">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="text" class="form-control" id="nisn" name="nisn" value="{{ old('nisn') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas" value="{{ old('kelas') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select form-select-lg" id="role" name="role" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success btn-lg me-2">
                                <i class="bi bi-plus-circle me-1"></i>Tambah
                            </button>
                            <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="bi bi-x-circle me-1"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
