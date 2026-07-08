import os

base_dir = r"e:\Local disk d\Desktop\LaravelProjects\MentorLink"

files = {}

files["public/css/custom.css"] = r"""/* =============================================================
   MentorLink — Custom Design System (Premium SaaS Polish)
   ============================================================= */

@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap');

:root {
  --ml-primary:       #4f46e5;
  --ml-primary-dark:  #3730a3;
  --ml-primary-light: #e0e7ff;
  --ml-accent:        #0ea5e9;
  --ml-success:       #10b981;
  --ml-warning:       #f59e0b;
  --ml-danger:        #ef4444;
  --ml-body-bg:       #f8fafc;
  --ml-card-bg:       #ffffff;
  --ml-border:        #e2e8f0;
  --ml-border-soft:   #f1f5f9;
  --ml-text-dark:     #0f172a;
  --ml-text-muted:    #64748b;
  --ml-shadow-sm:     0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --ml-shadow:        0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
  --ml-shadow-lg:     0 10px 25px -3px rgba(0, 0, 0, 0.08), 0 4px 10px -2px rgba(0, 0, 0, 0.04);
  --ml-shadow-xl:     0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  --ml-radius:        1rem;
  --ml-radius-lg:     1.5rem;
}

body {
  font-family: 'Inter', sans-serif;
  background-color: var(--ml-body-bg);
  color: var(--ml-text-dark);
  -webkit-font-smoothing: antialiased;
  background-image: radial-gradient(circle at 15% 50%, rgba(79, 70, 229, 0.03), transparent 25%), radial-gradient(circle at 85% 30%, rgba(14, 165, 233, 0.03), transparent 25%);
  background-attachment: fixed;
}

h1, h2, h3, h4, h5, h6, .font-heading {
  font-family: 'Outfit', sans-serif;
  font-weight: 700;
  color: var(--ml-text-dark);
  letter-spacing: -0.02em;
}

.bg-slate-50 { background-color: var(--ml-body-bg) !important; }
.tracking-wide { letter-spacing: 0.05em; }

/* =============================================================
   LAYOUT & HEADER
   ============================================================= */

.page-content {
  padding: 0 0 3rem 0;
  min-height: calc(100vh - 72px);
}

.page-inner {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 1.5rem;
}

/* Premium Page Hero */
.page-hero {
  background: linear-gradient(135deg, var(--ml-primary-dark) 0%, var(--ml-primary) 50%, var(--ml-accent) 100%);
  padding: 3.5rem 0 5.5rem 0;
  margin-bottom: -3.5rem;
  position: relative;
  overflow: hidden;
}

.page-hero::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  pointer-events: none;
}

.page-hero-inner {
  position: relative;
  z-index: 10;
}

/* =============================================================
   NAVIGATION
   ============================================================= */
.navbar-glass {
  background: rgba(255,255,255,0.85) !important;
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border-bottom: 1px solid rgba(255,255,255,0.4) !important;
  box-shadow: 0 1px 0 rgba(0,0,0,0.02);
}

.navbar-brand {
  font-family: 'Outfit', sans-serif;
  font-weight: 800;
  font-size: 1.35rem;
  color: var(--ml-text-dark) !important;
}

.navbar-brand .logo-icon {
  background: linear-gradient(135deg, var(--ml-primary) 0%, var(--ml-accent) 100%);
  color: white;
  width: 36px; height: 36px;
  border-radius: 10px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
}

.navbar-glass .nav-link {
  font-weight: 500;
  color: var(--ml-text-muted) !important;
  font-size: 0.95rem;
  padding: 0.5rem 1rem !important;
  border-radius: 0.75rem;
  transition: all 0.2s ease;
  margin: 0 0.25rem;
}

.navbar-glass .nav-link:hover, .navbar-glass .nav-link.active {
  color: var(--ml-primary) !important;
  background: var(--ml-primary-light);
  font-weight: 600 !important;
}

.nav-user-chip {
  background: var(--ml-card-bg);
  border: 1px solid var(--ml-border);
  box-shadow: var(--ml-shadow-sm);
  padding: 0.25rem 1rem 0.25rem 0.25rem;
  border-radius: 2rem;
  font-weight: 600;
  color: var(--ml-text-dark);
  transition: all 0.2s ease;
}

.nav-user-chip:hover {
  border-color: var(--ml-primary);
  box-shadow: 0 0 0 3px var(--ml-primary-light);
}

/* =============================================================
   CARDS & PANELS
   ============================================================= */

.card {
  border: 1px solid rgba(255,255,255,0.5);
  border-radius: var(--ml-radius);
  box-shadow: var(--ml-shadow);
  background: rgba(255,255,255,0.95);
}

.card-elevated {
  border: 1px solid rgba(255,255,255,0.8) !important;
  box-shadow: var(--ml-shadow-lg) !important;
  border-radius: var(--ml-radius-lg) !important;
  background: #ffffff !important;
}

.card-header {
  background: transparent;
  border-bottom: 1px solid var(--ml-border-soft);
  padding: 1.25rem 1.5rem;
}

.stat-card {
  border-radius: var(--ml-radius-lg);
  background: #ffffff;
  border: 1px solid rgba(255,255,255,0.8);
  box-shadow: var(--ml-shadow);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  overflow: hidden;
  position: relative;
}

.stat-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--ml-shadow-xl);
}

.stat-icon-wrapper {
  border-radius: 1rem;
  box-shadow: inset 0 2px 4px rgba(255,255,255,0.5), 0 4px 6px rgba(0,0,0,0.05);
}

/* =============================================================
   TABLES
   ============================================================= */

.table-responsive {
  border-radius: var(--ml-radius);
}

.table {
  margin-bottom: 0;
  color: var(--ml-text-dark);
}

.table > :not(caption) > * > * {
  padding: 1.25rem 1.5rem;
  background-color: transparent;
  border-bottom-color: var(--ml-border-soft);
  vertical-align: middle;
}

.table thead th {
  background: #f8fafc;
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  color: var(--ml-text-muted);
  border-bottom: none;
}

.table tbody tr {
  transition: all 0.2s ease;
}

.table tbody tr:hover {
  background-color: var(--ml-body-bg);
}

/* =============================================================
   BUTTONS
   ============================================================= */

.btn {
  font-weight: 600;
  font-family: 'Outfit', sans-serif;
  padding: 0.6rem 1.25rem;
  border-radius: 0.75rem;
  transition: all 0.2s ease;
  letter-spacing: 0.01em;
}

.btn-primary {
  background: linear-gradient(135deg, var(--ml-primary) 0%, var(--ml-primary-dark) 100%);
  border: none;
  color: white;
  box-shadow: 0 4px 6px rgba(79, 70, 229, 0.25);
}

.btn-primary:hover {
  background: linear-gradient(135deg, var(--ml-primary-dark) 0%, #312e81 100%);
  box-shadow: 0 6px 12px rgba(79, 70, 229, 0.35);
  transform: translateY(-2px);
  color: white;
}

.btn-outline-primary {
  border: 2px solid var(--ml-primary);
  color: var(--ml-primary);
  background: transparent;
}
.btn-outline-primary:hover {
  background: var(--ml-primary-light);
  color: var(--ml-primary-dark);
  border-color: var(--ml-primary-dark);
}

.btn-light {
  background: #ffffff;
  border: 1px solid var(--ml-border);
  color: var(--ml-text-dark);
  box-shadow: var(--ml-shadow-sm);
}

.btn-light:hover {
  background: #f8fafc;
  border-color: #cbd5e1;
}

.hover-lift-btn:hover {
  transform: translateY(-2px);
}

/* =============================================================
   BADGES & STATUS
   ============================================================= */

.badge {
  font-family: 'Outfit', sans-serif;
  padding: 0.4em 0.85em;
  border-radius: 2rem;
  font-weight: 600;
  letter-spacing: 0.02em;
}

.badge-status-pending { background: #fef3c7; color: #92400e; }
.badge-status-accepted { background: #d1fae5; color: #065f46; }
.badge-status-completed { background: #e0e7ff; color: #3730a3; }
.badge-status-rejected { background: #fee2e2; color: #991b1b; }
.badge-status-cancelled { background: #f1f5f9; color: #475569; }

/* =============================================================
   FORMS & INPUTS
   ============================================================= */

.form-control, .form-select {
  border-color: var(--ml-border);
  border-radius: 0.75rem;
  padding: 0.6rem 1rem;
  font-size: 0.95rem;
  background: #fff;
  transition: all 0.2s ease;
  box-shadow: var(--ml-shadow-sm);
}

.form-control:focus, .form-select:focus {
  border-color: var(--ml-primary);
  box-shadow: 0 0 0 4px var(--ml-primary-light);
}

.input-group-text {
  background: #f8fafc;
  border-color: var(--ml-border);
  border-top-left-radius: 0.75rem;
  border-bottom-left-radius: 0.75rem;
}

/* =============================================================
   MENTOR CARD & PROFILE
   ============================================================= */

.mentor-card {
  border: 1px solid var(--ml-border-soft);
  border-radius: var(--ml-radius-lg);
  background: #fff;
  overflow: hidden;
  transition: all 0.3s ease;
  box-shadow: var(--ml-shadow);
}

.mentor-card:hover {
  transform: translateY(-6px);
  box-shadow: var(--ml-shadow-xl);
}

.mentor-card-banner {
  height: 80px;
  background: linear-gradient(135deg, var(--ml-primary-light) 0%, #f3e8ff 100%);
  position: relative;
}

.mentor-card-avatar {
  width: 80px; height: 80px;
  border-radius: 50%;
  border: 4px solid #fff;
  box-shadow: var(--ml-shadow);
  margin-top: -40px;
  position: relative;
  z-index: 2;
  background: #fff;
}

/* =============================================================
   ANIMATIONS
   ============================================================= */

.fade-in {
  animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}

.fade-in-stagger > * {
  opacity: 0;
  animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

.fade-in-stagger > *:nth-child(1) { animation-delay: 0.05s; }
.fade-in-stagger > *:nth-child(2) { animation-delay: 0.1s; }
.fade-in-stagger > *:nth-child(3) { animation-delay: 0.15s; }
.fade-in-stagger > *:nth-child(4) { animation-delay: 0.2s; }
.fade-in-stagger > *:nth-child(5) { animation-delay: 0.25s; }
.fade-in-stagger > *:nth-child(6) { animation-delay: 0.3s; }

/* Admin sidebar polish */
.admin-sidebar {
  background: #ffffff;
  border-right: 1px solid var(--ml-border);
  box-shadow: 1px 0 10px rgba(0,0,0,0.02);
}

.admin-sidebar .nav-link {
  font-family: 'Outfit', sans-serif;
  font-weight: 600;
  padding: 0.75rem 1rem;
  border-radius: 0.75rem;
  color: var(--ml-text-muted);
  margin-bottom: 0.25rem;
  transition: all 0.2s;
}

.admin-sidebar .nav-link.active {
  background: var(--ml-primary-light);
  color: var(--ml-primary-dark);
}

.admin-sidebar .nav-link:hover:not(.active) {
  background: var(--ml-body-bg);
  color: var(--ml-text-dark);
}

.admin-topbar {
  background: rgba(255,255,255,0.9) !important;
  backdrop-filter: blur(12px);
  border-bottom: 1px solid var(--ml-border) !important;
}

.admin-topbar .navbar-brand {
  color: var(--ml-primary-dark) !important;
}

/* Stat card colors */
.stat-colored {
  background: linear-gradient(135deg, var(--ml-primary) 0%, var(--ml-primary-dark) 100%);
  color: white;
}
.stat-colored .text-muted {
  color: rgba(255,255,255,0.8) !important;
}
.stat-colored h2 {
  color: white;
}

/* Empty States */
.empty-state {
  padding: 4rem 2rem;
  text-align: center;
  background: #ffffff;
  border-radius: var(--ml-radius-lg);
  border: 1px dashed var(--ml-border);
  box-shadow: var(--ml-shadow-sm);
}

.empty-state-icon {
  width: 80px; height: 80px;
  border-radius: 50%;
  background: var(--ml-primary-light);
  color: var(--ml-primary);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 2.5rem;
  margin: 0 auto 1.5rem auto;
}
"""

files["resources/views/layouts/app.blade.php"] = r"""<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MentorLink') }} — @yield('title', 'Dashboard')</title>
        <meta name="description" content="MentorLink — Connect students with expert mentors for guided learning sessions.">

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

        <!-- Custom Design System -->
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

        <!-- Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">

        {{-- Flash Messages (auto-dismiss) --}}
        @if(session('success') || session('error'))
        <div id="flash-toast-container" aria-live="polite" aria-atomic="true"
             style="position:fixed;top:5rem;right:1.5rem;z-index:9999;min-width:320px;max-width:420px;">
            @if(session('success'))
            <div class="toast show align-items-center text-bg-success border-0 shadow-lg mb-2" role="alert"
                 id="toast-success" style="border-radius:1rem;overflow:hidden;">
                <div class="d-flex p-1">
                    <div class="toast-body fw-medium d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
            @endif
            @if(session('error'))
            <div class="toast show align-items-center text-bg-danger border-0 shadow-lg mb-2" role="alert"
                 id="toast-error" style="border-radius:1rem;overflow:hidden;">
                <div class="d-flex p-1">
                    <div class="toast-body fw-medium d-flex align-items-center gap-2">
                        <i class="bi bi-exclamation-circle-fill fs-5"></i>
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
            @endif
        </div>
        @endif

        <div class="d-flex flex-column" style="min-height:100vh;">
            {{-- Navigation --}}
            @include('layouts.navigation')

            {{-- Page Heading (Hero Area) --}}
            @isset($header)
                <div class="page-hero shadow-sm">
                    <div class="page-inner page-hero-inner">
                        {{ $header }}
                    </div>
                </div>
            @endisset

            {{-- Page Content --}}
            <main class="flex-grow-1 page-content mt-5">
                <div class="page-inner">
                    {{ $slot }}
                </div>
            </main>

            {{-- Footer --}}
            <footer class="py-4 mt-auto bg-white border-top border-soft">
                <div class="page-inner">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                        <span class="text-muted small fw-medium">
                            &copy; {{ date('Y') }}
                            <strong class="text-primary font-heading fs-6">MentorLink</strong>
                        </span>
                        <span class="text-muted small">University Web Programming Lab Project</span>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastEls = document.querySelectorAll('#flash-toast-container .toast');
            toastEls.forEach(function(el) {
                var toast = new bootstrap.Toast(el, { delay: 5000 });
                toast.show();
            });
        });
        </script>
    </body>
</html>
"""

files["resources/views/layouts/navigation.blade.php"] = r"""<nav class="navbar navbar-expand-lg navbar-glass sticky-top" style="height:72px;">
    <div class="container-xl px-4">

        {{-- Logo / Brand --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
            <span class="logo-icon">
                <i class="bi bi-mortarboard-fill" style="font-size:1.1rem;"></i>
            </span>
            <span>MentorLink</span>
        </a>

        {{-- Hamburger --}}
        <button class="navbar-toggler border-0 shadow-none" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Links --}}
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a id="nav-dashboard"
                       class="nav-link {{ request()->routeIs('dashboard') || request()->routeIs('student.dashboard') || request()->routeIs('mentor.dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}">
                        <i class="bi bi-grid me-1"></i>Dashboard
                    </a>
                </li>

                @auth
                    @if(auth()->user()->role === \App\Models\User::ROLE_STUDENT)
                        <li class="nav-item">
                            <a id="nav-find-mentors"
                               class="nav-link {{ request()->routeIs('student.mentors.*') ? 'active' : '' }}"
                               href="{{ route('student.mentors.index') }}">
                                <i class="bi bi-search me-1"></i>Find Mentors
                            </a>
                        </li>

                    @elseif(auth()->user()->role === \App\Models\User::ROLE_MENTOR)
                        <li class="nav-item">
                            <a id="nav-availability"
                               class="nav-link {{ request()->routeIs('mentor.availabilities.*') ? 'active' : '' }}"
                               href="{{ route('mentor.availabilities.index') }}">
                                <i class="bi bi-calendar3-week me-1"></i>Availability
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="nav-bookings"
                               class="nav-link {{ request()->routeIs('mentor.bookings.*') ? 'active' : '' }}"
                               href="{{ route('mentor.bookings.index') }}">
                                <i class="bi bi-journal-check me-1"></i>Bookings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="nav-reviews"
                               class="nav-link {{ request()->routeIs('mentor.reviews.*') ? 'active' : '' }}"
                               href="{{ route('mentor.reviews.index') }}">
                                <i class="bi bi-star me-1"></i>Reviews
                            </a>
                        </li>

                    @elseif(auth()->user()->role === \App\Models\User::ROLE_ADMIN)
                        <li class="nav-item">
                            <a id="nav-admin-panel"
                               class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}"
                               href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-shield-check me-1"></i>Admin Panel
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            {{-- Right Side --}}
            <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                @auth
                    {{-- Role badge --}}
                    @php
                        $roleLabel = match(auth()->user()->role) {
                            \App\Models\User::ROLE_ADMIN   => ['Admin',   'danger'],
                            \App\Models\User::ROLE_MENTOR  => ['Mentor',  'success'],
                            default                         => ['Student', 'primary'],
                        };
                    @endphp
                    <li class="nav-item d-none d-lg-flex align-items-center me-2">
                        <span class="badge bg-{{ $roleLabel[1] }} bg-opacity-10 text-{{ $roleLabel[1] }} border border-{{ $roleLabel[1] }}-subtle">
                            {{ $roleLabel[0] }}
                        </span>
                    </li>

                    {{-- User Dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle p-0 border-0 bg-transparent d-flex align-items-center text-decoration-none" href="#"
                           id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="nav-user-chip d-flex align-items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=e0e7ff&color=4f46e5&size=56"
                                     alt="{{ Auth::user()->name }}" class="rounded-circle" style="width:32px; height:32px;">
                                <span class="d-none d-md-inline pe-1">{{ Str::words(Auth::user()->name, 2, '') }}</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2 shadow-lg border-0" style="border-radius:1rem;" aria-labelledby="userDropdown">
                            <li class="px-4 py-2 border-bottom border-soft mb-1">
                                <p class="mb-0 fw-bold text-dark font-heading">{{ Auth::user()->name }}</p>
                                <p class="mb-0 text-muted small">{{ Auth::user()->email }}</p>
                            </li>
                            <li>
                                <a id="nav-profile" class="dropdown-item py-2 px-4" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2"></i>My Profile
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" id="nav-logout" class="dropdown-item text-danger py-2 px-4">
                                        <i class="bi bi-box-arrow-right me-2"></i>Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                @else
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ route('login') }}">Log in</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary shadow-sm px-4 ms-2" href="{{ route('register') }}">
                            Get Started Free
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
"""

files["resources/views/layouts/admin.blade.php"] = r"""<!DOCTYPE html>
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
<body class="bg-slate-50">

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
            <span class="text-dark fw-medium small d-none d-md-inline">
                {{ Auth::user()->name }}
            </span>
            <div class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" id="admin-logout"
                            class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-bold">
                        <i class="bi bi-box-arrow-right me-1"></i>
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
"""

files["resources/views/components/stat-card.blade.php"] = r"""@props([
    'title',
    'value',
    'icon',
    'color' => 'primary',
    'opacity' => '10'
])

<div class="card stat-card border-0 h-100">
    <div class="card-body p-4 d-flex align-items-center">
        <div class="bg-{{ $color }} bg-opacity-{{ $opacity }} text-{{ $color }} d-flex align-items-center justify-content-center me-4 stat-icon-wrapper" style="width: 64px; height: 64px;">
            <i class="bi bi-{{ $icon }} fs-2"></i>
        </div>
        <div>
            <h6 class="text-uppercase fw-bold mb-1 text-muted small" style="letter-spacing: 0.05em;">{{ $title }}</h6>
            <h2 class="mb-0 fw-bold font-heading text-dark">{{ $value }}</h2>
        </div>
    </div>
    <div class="position-absolute bottom-0 start-0 w-100" style="height: 4px; background: var(--bs-{{ $color }}); opacity: 0.8;"></div>
</div>
"""

files["resources/views/components/mentor-card.blade.php"] = r"""@props(['mentor'])

<div class="mentor-card h-100 d-flex flex-column">
    <div class="mentor-card-banner">
        @if($mentor->mentorProfile && $mentor->mentorProfile->is_verified)
            <span class="badge position-absolute top-0 end-0 m-3 shadow-sm"
                  style="background:rgba(255,255,255,0.9);color:#10b981;border:1px solid #10b981;"
                  title="Verified Mentor">
                <i class="bi bi-patch-check-fill me-1"></i>Verified
            </span>
        @endif
    </div>
    
    <div class="text-center px-4 pb-3" style="margin-top: -40px;">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=4f46e5&color=fff&size=150" 
             alt="{{ $mentor->name }}" 
             class="mentor-card-avatar mb-3">
        
        <h5 class="fw-bold font-heading mb-1 text-dark">{{ $mentor->name }}</h5>
        <p class="text-primary fw-medium small mb-2">{{ $mentor->mentorProfile->designation ?? 'Professional Mentor' }}</p>
        
        <div class="d-flex justify-content-center align-items-center gap-1 mb-2">
            @php $rating = $mentor->reviews_received_avg_rating ?? 0; @endphp
            @if($rating > 0)
                <div class="text-warning" style="font-size: 0.9rem;">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= round($rating) ? '-fill' : '' }}"></i>
                    @endfor
                </div>
                <span class="text-dark fw-bold small ms-1">{{ number_format($rating, 1) }}</span>
                <span class="text-muted small ms-1">({{ $mentor->reviews_received_count ?? 0 }})</span>
            @else
                <span class="badge bg-light text-muted border">New Mentor</span>
            @endif
        </div>
    </div>
    
    <div class="card-body p-4 pt-2 d-flex flex-column border-top border-soft">
        <div class="mb-4">
            <h6 class="text-uppercase fw-bold text-muted mb-2" style="font-size: 0.7rem; letter-spacing: 0.05em;">Top Skills</h6>
            <div class="d-flex flex-wrap gap-2">
                @if($mentor->mentorProfile && $mentor->mentorProfile->skills)
                    @forelse($mentor->mentorProfile->skills->take(3) as $skill)
                        <span class="badge bg-primary bg-opacity-10 text-primary fw-medium">{{ $skill->name }}</span>
                    @empty
                        <span class="text-muted small fst-italic">General Guidance</span>
                    @endforelse
                    @if($mentor->mentorProfile->skills->count() > 3)
                        <span class="badge bg-light text-muted border">+{{ $mentor->mentorProfile->skills->count() - 3 }}</span>
                    @endif
                @endif
            </div>
        </div>
        
        <div class="mt-auto">
            <a href="{{ route('student.mentors.show', $mentor->id) }}"
               class="btn btn-outline-primary w-100 hover-lift-btn fw-bold">
                View Profile
            </a>
        </div>
    </div>
</div>
"""

files["resources/views/student/dashboard.blade.php"] = r"""<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 class="mb-1 text-white font-heading display-6 fw-bold">
                    Student Dashboard
                </h2>
                <p class="mb-0 text-white opacity-75 fs-5">
                    Welcome back, <strong class="text-white">{{ Auth::user()->name }}</strong>
                </p>
            </div>
            <a href="{{ route('student.mentors.index') }}"
               class="btn btn-light btn-lg fw-bold text-primary shadow-sm hover-lift-btn px-4 rounded-pill">
                <i class="bi bi-search me-2"></i>Find a Mentor
            </a>
        </div>
    </x-slot>

    <div class="fade-in">
        {{-- Stat Cards --}}
        <div class="row g-4 mb-5 fade-in-stagger">
            <div class="col-sm-6 col-xl-3">
                <x-stat-card title="Total Requests" :value="$totalRequests" icon="send-fill" color="primary" />
            </div>
            <div class="col-sm-6 col-xl-3">
                <x-stat-card title="Upcoming Sessions" :value="$upcomingBookings->count()" icon="calendar-event-fill" color="success" />
            </div>
            <div class="col-sm-6 col-xl-3">
                <x-stat-card title="Pending Approvals" :value="$pendingBookings->count()" icon="hourglass-split" color="warning" />
            </div>
            <div class="col-sm-6 col-xl-3">
                <x-stat-card title="Completed Sessions" :value="$completedBookings->count()" icon="check-circle-fill" color="info" />
            </div>
        </div>

        {{-- Main Content Grid --}}
        <div class="row g-4 mb-4 fade-in-stagger">
            {{-- Left Column: Recent Bookings --}}
            <div class="col-lg-8">
                <div class="card card-elevated h-100 border-0">
                    <div class="card-header bg-white border-bottom border-soft px-4 py-3 d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 text-primary rounded p-2 me-3">
                            <i class="bi bi-calendar-check-fill"></i>
                        </div>
                        <h5 class="mb-0 fw-bold font-heading">Recent Bookings</h5>
                    </div>
                    <div class="card-body p-0">
                        @if($bookings->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4">Mentor</th>
                                            <th>Schedule</th>
                                            <th>Status</th>
                                            <th class="text-end pe-4">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bookings->take(5) as $booking)
                                            <tr>
                                                <td class="ps-4 py-3">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($booking->mentor->name) }}&background=4f46e5&color=fff&size=80"
                                                             class="rounded-circle shadow-sm" width="45" height="45" alt="{{ $booking->mentor->name }}">
                                                        <div>
                                                            <div class="fw-bold text-dark">{{ $booking->mentor->name }}</div>
                                                            <small class="text-muted">{{ $booking->mentor->mentorProfile->designation ?? 'Mentor' }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="fw-medium text-dark">{{ $booking->booking_date->format('M d, Y') }}</div>
                                                    <small class="text-muted">
                                                        <i class="bi bi-clock me-1"></i>
                                                        {{ \Carbon\Carbon::parse($booking->availability->start_time)->format('h:i A') }}
                                                    </small>
                                                </td>
                                                <td>
                                                    @if($booking->status == 'pending')
                                                        <span class="badge badge-status-pending"><i class="bi bi-clock me-1"></i>Pending</span>
                                                    @elseif($booking->status == 'accepted')
                                                        <span class="badge badge-status-accepted"><i class="bi bi-check-circle me-1"></i>Accepted</span>
                                                    @elseif($booking->status == 'rejected')
                                                        <span class="badge badge-status-rejected"><i class="bi bi-x-circle me-1"></i>Rejected</span>
                                                    @elseif($booking->status == 'cancelled')
                                                        <span class="badge badge-status-cancelled"><i class="bi bi-slash-circle me-1"></i>Cancelled</span>
                                                    @else
                                                        <span class="badge badge-status-completed"><i class="bi bi-check2-all me-1"></i>Completed</span>
                                                    @endif
                                                </td>
                                                <td class="text-end pe-4">
                                                    @if($booking->status == 'pending')
                                                        <form action="{{ route('student.bookings.cancel', $booking) }}" method="POST" class="d-inline" onsubmit="return confirm('Cancel this booking request?')">
                                                            @csrf @method('PATCH')
                                                            <button class="btn btn-sm btn-outline-danger px-3 fw-bold rounded-pill">Cancel</button>
                                                        </form>
                                                    @else
                                                        <span class="text-muted small">—</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state m-4">
                                <div class="empty-state-icon"><i class="bi bi-calendar-x"></i></div>
                                <h5>No Bookings Yet</h5>
                                <p class="text-muted">Start your journey by scheduling a session with an expert.</p>
                                <a href="{{ route('student.mentors.index') }}" class="btn btn-primary mt-2">Find a Mentor</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right Column: Action Items --}}
            <div class="col-lg-4 d-flex flex-column gap-4">
                {{-- Awaiting Review --}}
                <div class="card card-elevated border-0 flex-grow-1">
                    <div class="card-header bg-white border-bottom border-soft px-4 py-3 d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 text-warning rounded p-2 me-3">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <h5 class="mb-0 fw-bold font-heading">Needs Review</h5>
                    </div>
                    <div class="card-body p-0">
                        @if(isset($sessionsAwaitingReview) && $sessionsAwaitingReview->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($sessionsAwaitingReview->take(3) as $session)
                                    <div class="list-group-item p-4 border-bottom border-soft">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div class="fw-bold text-dark">{{ $session->mentor->name }}</div>
                                            <small class="text-muted">{{ $session->booking_date->format('M d') }}</small>
                                        </div>
                                        <a href="{{ route('student.reviews.create', $session) }}" class="btn btn-sm btn-outline-warning w-100 fw-bold">
                                            Leave Review
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center p-5">
                                <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex p-3 mb-3">
                                    <i class="bi bi-check2-all fs-3"></i>
                                </div>
                                <h6 class="fw-bold">All caught up!</h6>
                                <p class="text-muted small mb-0">No pending sessions to review.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
"""

files["resources/views/mentor/dashboard.blade.php"] = r"""<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 class="mb-1 text-white font-heading display-6 fw-bold">
                    Mentor Dashboard
                </h2>
                <p class="mb-0 text-white opacity-75 fs-5">
                    Welcome back, <strong class="text-white">{{ Auth::user()->name }}</strong>
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('mentor.availabilities.index') }}" class="btn btn-light btn-lg fw-bold text-primary shadow-sm hover-lift-btn rounded-pill px-4">
                    <i class="bi bi-calendar-plus me-2"></i>Availability
                </a>
            </div>
        </div>
    </x-slot>

    <div class="fade-in">
        {{-- Activity Stats --}}
        <div class="row g-4 mb-5 fade-in-stagger">
            <div class="col-md-4">
                <x-stat-card title="Pending Requests" :value="$pendingRequests->count()" icon="inbox-fill" color="warning" />
            </div>
            <div class="col-md-4">
                <x-stat-card title="Upcoming Sessions" :value="$upcomingBookings->count()" icon="camera-video-fill" color="primary" />
            </div>
            <div class="col-md-4">
                <x-stat-card title="Completed Sessions" :value="$completedBookings->count()" icon="check-circle-fill" color="success" />
            </div>
        </div>

        <div class="row g-4 mb-4 fade-in-stagger">
            {{-- Mentorship Requests --}}
            <div class="col-lg-7">
                <div class="card card-elevated h-100 border-0">
                    <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary rounded p-2 me-3">
                                <i class="bi bi-person-lines-fill"></i>
                            </div>
                            <h5 class="mb-0 fw-bold font-heading">Mentorship Requests</h5>
                        </div>
                        @if($pendingRequests->count() > 0)
                            <span class="badge bg-danger rounded-pill">{{ $pendingRequests->count() }} New</span>
                        @endif
                    </div>
                    <div class="card-body p-0">
                        @if($pendingRequests->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($pendingRequests as $request)
                                    <div class="list-group-item p-4 border-bottom border-soft">
                                        <div class="d-flex justify-content-between align-items-start gap-3">
                                            <div class="d-flex gap-3">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($request->student->name) }}&background=f1f5f9&color=475569&size=80"
                                                     class="rounded-circle shadow-sm" width="50" height="50" alt="Avatar">
                                                <div>
                                                    <h6 class="fw-bold text-dark mb-1">{{ $request->student->name }}</h6>
                                                    <p class="text-muted small mb-0" style="line-height: 1.5;">"{{ Str::limit($request->message, 80) }}"</p>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 flex-shrink-0">
                                                <form method="POST" action="{{ route('mentor.mentorship-requests.update', $request) }}">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button type="submit" class="btn btn-success btn-sm px-3 fw-bold rounded-pill text-white shadow-sm hover-lift-btn">Accept</button>
                                                </form>
                                                <form method="POST" action="{{ route('mentor.mentorship-requests.update', $request) }}">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="btn btn-light btn-sm px-3 fw-bold rounded-pill text-danger border">Decline</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state m-4">
                                <div class="empty-state-icon text-primary bg-primary bg-opacity-10"><i class="bi bi-inbox"></i></div>
                                <h5>Inbox Zero</h5>
                                <p class="text-muted">You have no pending mentorship requests right now.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Recent Reviews --}}
            <div class="col-lg-5">
                <div class="card card-elevated h-100 border-0">
                    <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 text-warning rounded p-2 me-3">
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <h5 class="mb-0 fw-bold font-heading">Your Ratings</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4 p-4 rounded-4 bg-slate-50 border border-soft">
                            <h1 class="display-4 fw-bold text-dark mb-0">{{ number_format($averageRating, 1) }}</h1>
                            <div class="text-warning fs-5 my-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= round($averageRating) ? '-fill' : '' }}"></i>
                                @endfor
                            </div>
                            <span class="text-muted fw-medium">Based on {{ $totalReviews }} reviews</span>
                        </div>

                        @if(isset($reviews) && $reviews->count() > 0)
                            <h6 class="fw-bold text-uppercase text-muted small mb-3">Latest Feedback</h6>
                            @foreach($reviews->take(2) as $review)
                                <div class="mb-3 p-3 rounded-3 bg-white border shadow-sm">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div class="fw-bold text-dark small">{{ $review->student->name }}</div>
                                        <div class="text-warning small">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-muted small mb-0 fst-italic">"{{ Str::limit($review->comment, 60) }}"</p>
                                </div>
                            @endforeach
                            <a href="{{ route('mentor.reviews.index') }}" class="btn btn-outline-primary w-100 fw-bold rounded-pill mt-2">View All Reviews</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
"""

files["resources/views/admin/dashboard.blade.php"] = r"""@extends('layouts.admin')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom border-soft">
    <div>
        <h2 class="fw-bold font-heading text-dark mb-1">Platform Overview</h2>
        <p class="text-muted mb-0 fs-5">Real-time metrics and system health</p>
    </div>
    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2 fw-bold shadow-sm d-flex align-items-center gap-2">
        <span class="spinner-grow spinner-grow-sm text-success" role="status"></span> System Online
    </span>
</div>

<div class="row g-4 mb-5 fade-in-stagger">
    {{-- High-level Colored Stats --}}
    <div class="col-xl-3 col-sm-6">
        <div class="card stat-card stat-colored border-0 h-100 shadow" style="background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="bi bi-people-fill position-absolute text-white opacity-10" style="font-size: 5rem; right: -10px; bottom: -20px;"></i>
                <p class="text-uppercase fw-bold mb-2 text-white opacity-75 small tracking-wide">Total Users</p>
                <h2 class="display-5 fw-bold mb-0">{{ $totalUsers }}</h2>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-sm-6">
        <div class="card stat-card stat-colored border-0 h-100 shadow" style="background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="bi bi-mortarboard-fill position-absolute text-white opacity-10" style="font-size: 5rem; right: -10px; bottom: -20px;"></i>
                <p class="text-uppercase fw-bold mb-2 text-white opacity-75 small tracking-wide">Active Students</p>
                <h2 class="display-5 fw-bold mb-0">{{ $totalStudents }}</h2>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card stat-card stat-colored border-0 h-100 shadow" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="bi bi-person-badge-fill position-absolute text-white opacity-10" style="font-size: 5rem; right: -10px; bottom: -20px;"></i>
                <p class="text-uppercase fw-bold mb-2 text-white opacity-75 small tracking-wide">Verified Mentors</p>
                <h2 class="display-5 fw-bold mb-0">{{ $verifiedMentors }}</h2>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card stat-card stat-colored border-0 h-100 shadow" style="background: linear-gradient(135deg, #f59e0b 0%, #b45309 100%);">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="bi bi-star-fill position-absolute text-white opacity-10" style="font-size: 5rem; right: -10px; bottom: -20px;"></i>
                <p class="text-uppercase fw-bold mb-2 text-white opacity-75 small tracking-wide">Avg Platform Rating</p>
                <h2 class="display-5 fw-bold mb-0">{{ number_format($averagePlatformRating, 1) }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-5 fade-in-stagger">
    <div class="col-lg-8">
        <div class="card card-elevated h-100 border-0">
            <div class="card-header bg-white border-bottom border-soft p-4 d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary rounded p-2 me-3">
                    <i class="bi bi-activity"></i>
                </div>
                <h5 class="mb-0 fw-bold font-heading">Platform Activity</h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4 text-center">
                    <div class="col-sm-4 border-end border-soft">
                        <p class="text-muted text-uppercase fw-bold small mb-2">Total Requests</p>
                        <h3 class="fw-bold text-dark">{{ $totalRequests }}</h3>
                    </div>
                    <div class="col-sm-4 border-end border-soft">
                        <p class="text-muted text-uppercase fw-bold small mb-2">Completed Sessions</p>
                        <h3 class="fw-bold text-success">{{ $completedSessions }}</h3>
                    </div>
                    <div class="col-sm-4">
                        <p class="text-muted text-uppercase fw-bold small mb-2">Total Reviews</p>
                        <h3 class="fw-bold text-warning">{{ $totalReviews }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card card-elevated h-100 border-0 bg-dark text-white shadow-lg overflow-hidden relative">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.05\' fill-rule=\'evenodd\'%3E%3Ccircle cx=\'3\' cy=\'3\' r=\'3\'/%3E%3Ccircle cx=\'13\' cy=\'13\' r=\'3\'/%3E%3C/g%3E%3C/svg%3E');"></div>
            <div class="card-body p-4 position-relative z-1 d-flex flex-column justify-content-center align-items-center text-center">
                <div class="bg-white bg-opacity-10 p-3 rounded-circle mb-3">
                    <i class="bi bi-building fs-1 text-white"></i>
                </div>
                <h4 class="font-heading fw-bold mb-1">{{ $totalDepartments }} Departments</h4>
                <p class="text-white-50 mb-4">{{ $totalSkills }} Registered Skills</p>
                <a href="{{ route('admin.departments.index') }}" class="btn btn-light rounded-pill px-4 fw-bold text-dark">Manage Catalog</a>
            </div>
        </div>
    </div>
</div>

@endsection
"""

files["resources/views/student/mentors/index.blade.php"] = r"""<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 class="mb-1 text-white font-heading display-6 fw-bold">
                    Mentor Directory
                </h2>
                <p class="mb-0 text-white opacity-75 fs-5">
                    Connect with industry experts and accelerate your growth.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="fade-in">
        {{-- Search & Filter Card --}}
        <div class="card card-elevated mb-5 border-0 shadow-lg" style="margin-top: -2rem; position: relative; z-index: 20;">
            <div class="card-body p-4 p-md-5">
                <form method="GET" action="{{ route('student.mentors.index') }}" id="mentor-filter-form">
                    <div class="row g-3">
                        <div class="col-lg-12 mb-2">
                            <div class="input-group input-group-lg shadow-sm border rounded-pill overflow-hidden">
                                <span class="input-group-text bg-white border-0 ps-4 text-primary">
                                    <i class="bi bi-search fs-5"></i>
                                </span>
                                <input type="text" name="search"
                                       class="form-control border-0 px-3 shadow-none bg-white"
                                       placeholder="Search by name, keyword or skill..."
                                       value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary px-5 fw-bold text-uppercase" style="letter-spacing: 0.05em; border-radius: 0 50rem 50rem 0;">
                                    Search
                                </button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small ms-1">Expertise Area</label>
                            <select name="skill" class="form-select bg-light border-0 shadow-none fw-medium">
                                <option value="">All Skills</option>
                                @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}" {{ request('skill') == $skill->id ? 'selected' : '' }}>
                                        {{ $skill->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small ms-1">Minimum Rating</label>
                            <select name="min_rating" class="form-select bg-light border-0 shadow-none fw-medium text-warning">
                                <option value="" class="text-dark">Any Rating</option>
                                <option value="5" {{ request('min_rating') == '5' ? 'selected' : '' }}>&#9733;&#9733;&#9733;&#9733;&#9733; 5 Stars</option>
                                <option value="4" {{ request('min_rating') == '4' ? 'selected' : '' }}>&#9733;&#9733;&#9733;&#9733;&#9734; 4+ Stars</option>
                                <option value="3" {{ request('min_rating') == '3' ? 'selected' : '' }}>&#9733;&#9733;&#9733;&#9734;&#9734; 3+ Stars</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small ms-1">Sort By</label>
                            <div class="d-flex gap-2">
                                <select name="sort" class="form-select bg-light border-0 shadow-none fw-medium flex-grow-1">
                                    <option value="">Newest First</option>
                                    <option value="highest_rated" {{ request('sort') == 'highest_rated' ? 'selected' : '' }}>Highest Rated</option>
                                    <option value="most_reviewed" {{ request('sort') == 'most_reviewed' ? 'selected' : '' }}>Most Reviewed</option>
                                </select>
                                @if(request('search') || request('skill') || request('min_rating') || request('sort'))
                                    <a href="{{ route('student.mentors.index') }}" class="btn btn-light border text-danger" title="Clear Filters">
                                        <i class="bi bi-x-lg"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Results --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="font-heading fw-bold mb-0">Our Mentors</h4>
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold border border-primary-subtle">
                {{ $mentors->total() }} Available
            </span>
        </div>

        <div class="row g-4 fade-in-stagger" id="mentor-results">
            @forelse($mentors as $mentor)
                <div class="col-md-6 col-xl-4">
                    <x-mentor-card :mentor="$mentor" />
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <div class="empty-state-icon"><i class="bi bi-search"></i></div>
                        <h4 class="font-heading fw-bold">No Mentors Found</h4>
                        <p class="text-muted fs-5">We couldn't find any mentors matching your exact filters.</p>
                        <a href="{{ route('student.mentors.index') }}" class="btn btn-primary rounded-pill px-5 mt-3 fw-bold shadow">
                            Reset Search
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        @if($mentors->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                {{ $mentors->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</x-app-layout>
"""

files["resources/views/student/mentors/show.blade.php"] = r"""<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-4">
                <div class="position-relative">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=ffffff&color=4f46e5&size=150"
                         class="rounded-circle shadow-lg border border-4 border-white"
                         style="width:90px;height:90px;object-fit:cover;" alt="{{ $mentor->name }}">
                </div>
                <div>
                    <h2 class="mb-1 text-white font-heading display-6 fw-bold">
                        {{ $mentor->name }}
                    </h2>
                    <p class="mb-0 text-white opacity-90 fs-5 fw-medium">
                        {{ $mentor->mentorProfile->designation ?? 'Professional Mentor' }}
                        @if($mentor->mentorProfile && $mentor->mentorProfile->is_verified)
                            <span class="badge bg-success border border-white ms-2 rounded-pill align-text-bottom"><i class="bi bi-patch-check-fill me-1"></i>Verified</span>
                        @endif
                    </p>
                </div>
            </div>
            <a href="{{ route('student.mentors.index') }}" class="btn btn-light btn-lg text-primary fw-bold shadow-sm rounded-pill px-4 hover-lift-btn">
                <i class="bi bi-arrow-left me-2"></i>Directory
            </a>
        </div>
    </x-slot>

    <div class="fade-in">
        <div class="row g-4">
            {{-- Main Content --}}
            <div class="col-lg-8">
                <div class="card card-elevated border-0 shadow-lg mb-4">
                    <div class="card-body p-4 p-md-5">
                        
                        <h4 class="font-heading fw-bold mb-4 d-flex align-items-center gap-2 text-dark">
                            <div class="bg-primary bg-opacity-10 text-primary rounded p-2"><i class="bi bi-person-lines-fill"></i></div>
                            About Me
                        </h4>
                        
                        @if($mentor->mentorProfile->bio)
                            <p class="text-secondary fs-5" style="white-space:pre-line;line-height:1.8;">{{ $mentor->mentorProfile->bio }}</p>
                        @else
                            <div class="bg-slate-50 rounded-4 p-4 text-center border border-soft">
                                <p class="text-muted fst-italic mb-0">This mentor hasn't added a bio yet.</p>
                            </div>
                        @endif

                        <hr class="my-5 border-soft">

                        <h4 class="font-heading fw-bold mb-4 d-flex align-items-center gap-2 text-dark">
                            <div class="bg-success bg-opacity-10 text-success rounded p-2"><i class="bi bi-briefcase-fill"></i></div>
                            Professional Experience
                        </h4>
                        
                        @if($mentor->mentorProfile->experience)
                            <p class="text-secondary" style="white-space:pre-line;line-height:1.75;">{{ $mentor->mentorProfile->experience }}</p>
                        @else
                            <div class="bg-slate-50 rounded-4 p-4 text-center border border-soft">
                                <p class="text-muted fst-italic mb-0">No experience details provided.</p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                {{-- Stats / Department --}}
                <div class="card card-elevated border-0 shadow-lg mb-4">
                    <div class="card-body p-4">
                        @php $rating = $mentor->mentorProfile->averageRating() ?? 0; @endphp
                        <div class="d-flex align-items-center justify-content-between mb-4 pb-4 border-bottom border-soft">
                            <div>
                                <p class="text-uppercase fw-bold text-muted small mb-1">Rating</p>
                                <div class="d-flex align-items-center gap-2">
                                    <h3 class="font-heading fw-bold mb-0 text-dark">{{ number_format($rating, 1) }}</h3>
                                    <div class="text-warning fs-5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= round($rating) ? '-fill' : '' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <p class="text-uppercase fw-bold text-muted small mb-1">Reviews</p>
                                <h3 class="font-heading fw-bold mb-0 text-dark">{{ $mentor->mentorProfile->totalReviews() }}</h3>
                            </div>
                        </div>

                        @if($mentor->mentorProfile && $mentor->mentorProfile->department)
                            <div class="mb-4">
                                <p class="text-uppercase fw-bold text-muted small mb-2">Department</p>
                                <div class="bg-slate-50 rounded-3 p-3 border border-soft d-flex align-items-center gap-3">
                                    <div class="bg-white rounded-circle p-2 shadow-sm"><i class="bi bi-building text-primary fs-5"></i></div>
                                    <span class="fw-bold text-dark">{{ $mentor->mentorProfile->department->name }}</span>
                                </div>
                            </div>
                        @endif

                        <div class="mb-2">
                            <p class="text-uppercase fw-bold text-muted small mb-2">Expertise & Skills</p>
                            <div class="d-flex flex-wrap gap-2">
                                @forelse($mentor->mentorProfile->skills as $skill)
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle px-3 py-2 rounded-pill fw-semibold">{{ $skill->name }}</span>
                                @empty
                                    <span class="text-muted small fst-italic">No specific skills listed.</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Card --}}
                @if($pendingRequest)
                    <div class="card border-warning bg-warning bg-opacity-10 shadow-sm rounded-4">
                        <div class="card-body p-4 text-center">
                            <i class="bi bi-hourglass-split text-warning display-4 mb-3"></i>
                            <h5 class="fw-bold text-dark font-heading">Request Pending</h5>
                            <p class="text-muted small mb-4">You have a pending mentorship request. Please wait for their response.</p>
                            <form method="POST" action="{{ route('student.mentorship-requests.destroy', $pendingRequest->id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100 fw-bold rounded-pill">Withdraw Request</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card border-0 bg-primary text-white shadow-lg rounded-4 overflow-hidden position-relative">
                        <div class="position-absolute top-0 end-0 p-4 opacity-25">
                            <i class="bi bi-rocket-takeoff-fill" style="font-size: 8rem;"></i>
                        </div>
                        <div class="card-body p-4 position-relative z-1">
                            <h4 class="font-heading fw-bold mb-2 text-white">Start Your Journey</h4>
                            <p class="text-white-50 mb-4">Send a request to connect with this mentor and schedule sessions.</p>
                            <form method="POST" action="{{ route('student.mentorship-requests.store') }}">
                                @csrf
                                <input type="hidden" name="mentor_id" value="{{ $mentor->id }}">
                                <div class="mb-4">
                                    <textarea name="message" rows="3" class="form-control border-0 bg-white bg-opacity-10 text-white placeholder-light shadow-none" required placeholder="Hi! I'd love your guidance on..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-light w-100 fw-bold text-primary rounded-pill btn-lg shadow hover-lift-btn">
                                    <i class="bi bi-send-fill me-2"></i>Send Request
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    
    <style>
    .placeholder-light::placeholder { color: rgba(255,255,255,0.6); }
    </style>
</x-app-layout>
"""

import sys

for path, content in files.items():
    full_path = os.path.join(base_dir, path)
    with open(full_path, "w", encoding="utf-8") as f:
        f.write(content)
    print(f"Updated {path}")
