@extends('admin.layout')
@section('content')
    <h1 class="mb-4">Dashboard Admin</h1>
    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-people fs-1 text-primary"></i>
                    <h5 class="card-title mt-2">Jumlah User</h5>
                    <p class="display-6 fw-bold">{{ $userCount }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
