<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - E-Presensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f6fa; }
        .sidebar {
            min-height: 100vh;
            background: #1e293b;
            color: #fff;
        }
        .sidebar .nav-link { color: #cbd5e1; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { background: #2563eb; color: #fff; }
        .sidebar .nav-link i { margin-right: 8px; }
        .navbar { background: #2563eb !important; }
        .navbar .navbar-brand, .navbar .nav-link, .navbar .navbar-text { color: #fff !important; }
        @media (max-width: 991.98px) {
            .sidebar { min-height: auto; }
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <nav class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 sidebar d-flex flex-column align-items-center align-items-sm-start pt-3">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4 fw-bold">E-Presensi</span>
            </a>
            <ul class="nav nav-pills flex-column mb-auto w-100">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-house"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Manajemen User
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.lokasi') }}" class="nav-link {{ request()->routeIs('admin.lokasi') ? 'active' : '' }}">
                        <i class="bi bi-geo-alt"></i> Lokasi Sekolah
                    </a>
                </li>
                <li class="mt-3">
                    <a href="{{ route('admin.logout') }}" class="nav-link text-danger">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>
        <div class="col py-0 px-0">
            <nav class="navbar navbar-expand-lg navbar-dark px-4">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">Admin Panel</span>
                    <span class="navbar-text ms-auto">{{ Auth::user()->name ?? 'Admin' }}</span>
                </div>
            </nav>
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>
