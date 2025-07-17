@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold m-0">Manajemen User</h1>
        <a href="{{ route('admin.create_user') }}" class="btn btn-primary">
            <i class="bi bi-person-plus-fill me-1"></i> Tambah User
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-custom">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">
                                    @if ($user->role === 'admin')
                                        <span class="badge bg-danger">Admin</span>
                                    @else
                                        <span class="badge bg-secondary text-capitalize">{{ $user->role }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.edit_user', $user->id) }}"
                                        class="btn btn-sm btn-outline-warning me-1" data-bs-toggle="tooltip" title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form action="{{ route('admin.delete_user', $user->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="tooltip" title="Hapus"
                                            onclick="return confirm('Yakin hapus user?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if (method_exists($users, 'links'))
                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
