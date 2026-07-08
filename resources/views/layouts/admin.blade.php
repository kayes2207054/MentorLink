<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MentorLink') }} — Admin Panel</title>
    <meta name="description" content="MentorLink Admin — Platform management dashboard.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Custom Design System -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>

    {{-- Top Navbar --}}
    <header class="admin-topbar navbar navbar-dark sticky-top flex-md-nowrap p-0">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-4 py-3" href="{{ route('admin.dashboard') }}">
            <span class="d-inline-flex align-items-center justify-content-center rounded-2 me-2"
                  style="width:26px;height:26px;background:rgba(255,255,255,.2);">
                <i class="bi bi-shield-fill-check" style="font-size:.8rem;"></i>
            </span>
            MentorLink Admin
        </a>

        <button class="navbar-toggler position-absolute d-md-none collapsed border-0"
                type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-nav ms-auto pe-3 flex-row align-items-center gap-3">
            <span class="text-white-50 small d-none d-md-inline">
                <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
            </span>
            <div class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" id="admin-logout"
                            class="btn btn-sm d-flex align-items-center gap-1"
                            style="background:rgba(255,255,255,.15);color:#fff;border:1px solid rgba(255,255,255,.25);border-radius:.5rem;font-weight:600;font-size:.8rem;">
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
                <div class="position-sticky" style="top:64px;padding-top:.75rem;padding-bottom:1.5rem;">

                    {{-- Navigation Group: Overview --}}
                    <div class="px-3 mb-1">
                        <p class="text-uppercase fw-bold mb-1"
                           style="font-size:.65rem;color:#94a3b8;letter-spacing:.08em;padding:.5rem 1rem .25rem;">
                            Overview
                        </p>
                    </div>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                               href="{{ route('admin.dashboard') }}" id="sidebar-dashboard">
                                <i class="bi bi-grid-1x2-fill"></i> Dashboard
                            </a>
                        </li>
                    </ul>

                    {{-- Navigation Group: Users --}}
                    <div class="px-3 mb-1">
                        <p class="text-uppercase fw-bold mb-1"
                           style="font-size:.65rem;color:#94a3b8;letter-spacing:.08em;padding:.5rem 1rem .25rem;">
                            Users
                        </p>
                    </div>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                               href="{{ route('admin.users.index') }}" id="sidebar-users">
                                <i class="bi bi-people-fill"></i> All Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.mentors.*') ? 'active' : '' }}"
                               href="{{ route('admin.mentors.index') }}" id="sidebar-mentors">
                                <i class="bi bi-person-badge-fill"></i> Mentor Verification
                            </a>
                        </li>
                    </ul>

                    {{-- Navigation Group: Content --}}
                    <div class="px-3 mb-1">
                        <p class="text-uppercase fw-bold mb-1"
                           style="font-size:.65rem;color:#94a3b8;letter-spacing:.08em;padding:.5rem 1rem .25rem;">
                            Content
                        </p>
                    </div>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}"
                               href="{{ route('admin.departments.index') }}" id="sidebar-departments">
                                <i class="bi bi-building-fill"></i> Departments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}"
                               href="{{ route('admin.skills.index') }}" id="sidebar-skills">
                                <i class="bi bi-lightning-fill"></i> Skills
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}"
                               href="{{ route('admin.reviews.index') }}" id="sidebar-reviews">
                                <i class="bi bi-star-fill"></i> Reviews
                            </a>
                        </li>
                    </ul>

                    {{-- Back to App --}}
                    <div class="px-3 mt-4 pt-3 border-top border-soft">
                        <a href="{{ route('dashboard') }}" class="btn btn-sm w-100"
                           style="background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0;font-weight:600;border-radius:.6rem;">
                            <i class="bi bi-arrow-left me-1"></i> Back to App
                        </a>
                    </div>
                </div>
            </nav>

            {{-- Main Content --}}
            <main class="col-md-9 ms-sm-auto col-lg-10 px-0 admin-content">
                <div class="px-md-4 py-4">

                    {{-- Flash Messages --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Page Content --}}
                    @yield('content')
                </div>
            </main>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
