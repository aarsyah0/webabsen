<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - E-Presensi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --sidebar-bg: #004a99;
            --sidebar-hover: #0066cc;
            --navbar-bg: #005bb5;
            --link-active-bg: #007fff;
            --body-bg: #f7fbff;
            --card-bg: #ffffff;
            --card-shadow: rgba(0, 0, 0, 0.1);
            --text-main: #1e293b;
            --text-light: #ffffff;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--body-bg);
            color: var(--text-main);
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background-color: var(--sidebar-bg);
            position: fixed;
            transition: width 0.3s;
            box-shadow: 2px 0 12px var(--card-shadow);
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar .nav-link {
            color: var(--text-light);
            padding: 0.75rem 1rem;
            margin: 0.25rem 0;
            border-radius: 0.375rem;
            transition: background 0.3s;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link:hover {
            background-color: var(--sidebar-hover);
            text-decoration: none;
        }

        .sidebar .nav-link.active {
            background-color: var(--link-active-bg);
            box-shadow: inset 4px 0 0 var(--text-light);
        }

        .sidebar .bi {
            font-size: 1.3rem;
        }

        .sidebar .link-text {
            margin-left: 0.75rem;
            opacity: 1;
            transition: opacity 0.3s;
        }

        .sidebar.collapsed .link-text {
            opacity: 0;
        }

        /* Top Navbar */
        .navbar {
            margin-left: 240px;
            background-color: var(--navbar-bg) !important;
            box-shadow: 0 2px 8px var(--card-shadow);
            transition: margin-left 0.3s;
        }

        .sidebar.collapsed~.navbar {
            margin-left: 70px;
        }

        .navbar .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--text-light);
        }

        .navbar .nav-link {
            color: var(--text-light) !important;
            transition: color 0.3s;
        }

        /* Content */
        .content-wrapper {
            margin-left: 240px;
            padding: 2rem;
            transition: margin-left 0.3s;
        }

        .sidebar.collapsed~.content-wrapper {
            margin-left: 70px;
        }

        /* Cards */
        .card-custom {
            background-color: var(--card-bg);
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 6px 18px var(--card-shadow);
            transition: transform 0.3s;
        }

        .card-custom:hover {
            transform: translateY(-6px);
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 1rem;
            color: var(--text-light);
            background-color: var(--navbar-bg);
        }

        /* Toggle Button */
        .toggle-btn {
            font-size: 1.5rem;
            color: var(--text-light);
            cursor: pointer;
            transition: transform 0.3s;
        }

        .toggle-btn:hover {
            transform: rotate(90deg);
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3" id="sidebar">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <span class="fs-4 fw-bold text-light text-truncate">E-Presensi</span>
            <i id="toggleSidebar" class="bi bi-list toggle-btn"></i>
        </div>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users') }}"
                    class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span class="link-text">Manajemen User</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.lokasi') }}"
                    class="nav-link {{ request()->routeIs('admin.lokasi') ? 'active' : '' }}">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span class="link-text">Lokasi Sekolah</span>
                </a>
            </li>
        </ul>
        <div class="mt-auto">
            <a href="{{ route('admin.logout') }}" class="nav-link text-light">
                <i class="bi bi-box-arrow-right"></i>
                <span class="link-text">Logout</span>
            </a>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <span class="navbar-brand">Admin Panel</span>
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-4 me-2"></i>{{ Auth::user()->name ?? 'Admin' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i
                                    class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div class="content-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });
        new bootstrap.Tooltip(document.body, {
            selector: '[data-bs-toggle="tooltip"]'
        });
    </script>
</body>

</html>
