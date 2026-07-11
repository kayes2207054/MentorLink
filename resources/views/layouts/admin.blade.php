<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MentorLink') }} — Admin Panel</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Custom Design System -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="antialiased">

    {{-- Top Navbar --}}
    <header class="admin-topbar navbar sticky-top flex-md-nowrap p-0 shadow-sm" style="height:72px;">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-4 py-3 d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
            <span class="logo-icon bg-primary text-white d-flex align-items-center justify-content-center rounded" style="width:32px;height:32px;">
                <i class="bi bi-shield-check"></i>
            </span>
            Admin Panel
        </a>

        <button class="navbar-toggler position-absolute d-md-none collapsed border-0 me-3"
                type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="w-100 d-none d-md-block px-4">
            <span class="text-muted small fw-medium"><i class="bi bi-clock me-1"></i> {{ date('F j, Y') }}</span>
        </div>

        <div class="navbar-nav ms-auto pe-4 flex-row align-items-center gap-3">
            <div class="nav-user-chip d-none d-md-flex align-items-center gap-2 ps-1">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 28px; height: 28px; font-size: 0.75rem;">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <span class="small">{{ Auth::user()->name }}</span>
            </div>
            <div class="nav-item">
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" id="admin-logout"
                            class="btn btn-soft-danger btn-sm rounded-pill px-3 fw-bold d-flex align-items-center gap-1">
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="d-none d-sm-inline">Sign Out</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="container-fluid px-0">
        <div class="row g-0">
            {{-- Sidebar --}}
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block admin-sidebar collapse">
                <div class="position-sticky pt-4 px-2" style="top:72px; height: calc(100vh - 72px); overflow-y:auto;">
                    
                    <p class="text-uppercase fw-bold text-muted small px-3 mb-2 tracking-wide">Overview</p>
                    <ul class="nav flex-column mb-4">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                               href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-grid-fill me-2"></i> Dashboard
                            </a>
                        </li>
                    </ul>

                    <p class="text-uppercase fw-bold text-muted small px-3 mb-2 tracking-wide">Management</p>
                    <ul class="nav flex-column mb-4">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                               href="{{ route('admin.users.index') }}">
                                <i class="bi bi-people-fill me-2"></i> Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.mentors.*') ? 'active' : '' }}"
                               href="{{ route('admin.mentors.index') }}">
                                <i class="bi bi-patch-check-fill me-2"></i> Mentors
                            </a>
                        </li>
                    </ul>

                    <p class="text-uppercase fw-bold text-muted small px-3 mb-2 tracking-wide">Platform Content</p>
                    <ul class="nav flex-column mb-4">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}"
                               href="{{ route('admin.departments.index') }}">
                                <i class="bi bi-building-fill me-2"></i> Departments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}"
                               href="{{ route('admin.skills.index') }}">
                                <i class="bi bi-lightning-charge-fill me-2"></i> Skills
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}"
                               href="{{ route('admin.reviews.index') }}">
                                <i class="bi bi-star-fill me-2"></i> Reviews
                            </a>
                        </li>
                    </ul>

                    <div class="px-3 mt-auto mb-4">
                        <a href="{{ route('dashboard') }}" class="btn btn-light w-100 shadow-sm fw-bold border-0 text-primary">
                            <i class="bi bi-arrow-left-circle me-2"></i> Back to App
                        </a>
                    </div>
                </div>
            </nav>

            {{-- Main Content --}}
            <main class="col-md-9 ms-sm-auto col-lg-10 px-0 admin-content pb-5">
                <div class="p-4 p-md-5">

                    {{-- Flash Messages --}}
                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4" role="alert">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
