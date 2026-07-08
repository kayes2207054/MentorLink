<nav class="navbar navbar-expand-lg navbar-glass sticky-top" style="height:72px;">
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
