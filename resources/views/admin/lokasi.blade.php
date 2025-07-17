<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lokasi Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Edit Lokasi Sekolah</h1>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('admin.update_lokasi') }}" method="POST">
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
    </form>
</div>
</body>
</html>
