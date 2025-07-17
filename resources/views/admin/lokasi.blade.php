@extends('admin.layout')
@section('content')
    <h1 class="mb-4">Edit Lokasi Sekolah</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('admin.update_lokasi') }}" method="POST" class="card p-4 shadow-sm" style="max-width:500px;">
        @csrf
        <div class="mb-3">
            <label for="lat" class="form-label">Latitude</label>
            <input type="text" class="form-control" id="lat" name="lat" value="{{ $lat }}" required>
        </div>
        <div class="mb-3">
            <label for="long" class="form-label">Longitude</label>
            <input type="text" class="form-control" id="long" name="long" value="{{ $long }}" required>
        </div>
        <div class="mb-3">
            <label for="radius" class="form-label">Radius (meter)</label>
            <input type="number" class="form-control" id="radius" name="radius" value="{{ $radius }}" required min="1">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary ms-2">Batal</a>
    </form>
@endsection
