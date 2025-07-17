@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold m-0">Manajemen Absen</h1>
        <form method="get" class="d-flex align-items-center">
            <input type="date" name="tanggal" value="{{ $tanggal }}" class="form-control me-2" style="width: 180px;">
            <select name="kelas" class="form-select me-2" style="width: 180px;">
                <option value="">Semua Kelas</option>
                @foreach($daftarKelas as $k)
                    <option value="{{ $k }}" {{ $kelas == $k ? 'selected' : '' }}>{{ $k }}</option>
                @endforeach
            </select>
            <button class="btn btn-primary">Filter</button>
        </form>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom-0">
            <h5 class="card-title mb-0 text-secondary">
                Daftar Presensi Siswa
                <small class="text-muted">({{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }})</small>
            </h5>
        </div>
        <div class="card-body pt-0">
            @if ($presensis->isEmpty())
                <p class="text-center text-muted my-5">Belum ada data presensi untuk tanggal ini.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">Nama Siswa</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presensis as $p)
                                <tr>
                                    <td class="px-4">{{ $p->user->name }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.absen_update', $p->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <select name="status" class="form-select form-select-sm d-inline-block"
                                                style="width: auto;" onchange="this.form.submit()">
                                                <option value="hadir" {{ $p->status == 'hadir' ? 'selected' : '' }}>Hadir
                                                </option>
                                                <option value="izin" {{ $p->status == 'izin' ? 'selected' : '' }}>Izin
                                                </option>
                                                <option value="sakit" {{ $p->status == 'sakit' ? 'selected' : '' }}>Sakit
                                                </option>
                                                <option value="alfa" {{ $p->status == 'alfa' ? 'selected' : '' }}>Alfa
                                                </option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-muted">
                                            {{ \Carbon\Carbon::parse($p->waktu)->format('H:i:s') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
