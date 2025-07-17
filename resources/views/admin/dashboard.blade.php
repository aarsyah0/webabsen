@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold m-0">Dashboard Admin</h1>
        <small class="text-muted">{{ now()->format('l, j F Y') }}</small>
    </div>

    <div class="row g-4 mb-5">
        {{-- Jumlah User --}}
        <div class="col-sm-6 col-lg-4">
            <div class="card-custom p-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 p-3 bg-primary bg-opacity-10 rounded-circle">
                        <i class="bi bi-people-fill fs-2 text-primary"></i>
                    </div>
                    <div>
                        <h6 class="text-uppercase text-muted mb-1">Jumlah User</h6>
                        <h2 class="fw-bold mb-0">{{ $userCount }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Presensi Hari Ini --}}
        <div class="col-sm-6 col-lg-4">
            <div class="card-custom p-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 p-3 bg-success bg-opacity-10 rounded-circle">
                        <i class="bi bi-calendar-check-fill fs-2 text-success"></i>
                    </div>
                    <div>
                        <h6 class="text-uppercase text-muted mb-1">Presensi Hari Ini</h6>
                        <h2 class="fw-bold mb-0">{{ $todayPresensiCount }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Lokasi Sekolah --}}
        <div class="col-sm-6 col-lg-4">
            <div class="card-custom p-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 p-3 bg-warning bg-opacity-10 rounded-circle">
                        <i class="bi bi-geo-alt-fill fs-2 text-warning"></i>
                    </div>
                    <div>
                        <h6 class="text-uppercase text-muted mb-1">Lokasi Sekolah</h6>
                        <p class="mb-0">{{ $setting['school_lat'] }}, {{ $setting['school_long'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar Presensi Hari Ini --}}
    <div class="card card-custom shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Detail Presensi Hari Ini</h5>
            @if ($todayPresensi->isEmpty())
                <p class="text-muted">Belum ada presensi hari ini.</p>
            @else
                <ul class="list-group list-group-flush">
                    @foreach ($todayPresensi as $presensi)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-person-circle me-2"></i>
                                {{ $presensi->user->name }}
                            </div>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($presensi->waktu)->format('H:i:s') }}</small>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
