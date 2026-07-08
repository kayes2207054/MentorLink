<nav class="navbar navbar-expand-lg navbar-glass sticky-top" style="height:64px;">
    <div class="container-xl">

        {{-- Logo / Brand --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
            <span class="d-inline-flex align-items-center justify-content-center rounded-3 shadow-sm"
                  style="width:34px;height:34px;background:linear-gradient(135deg,#4f46e5 0%,#7c3aed 100%);">
                <i class="bi bi-mortarboard-fill text-white" style="font-size:.95rem;"></i>
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
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">
                <li class="nav-item">
                    <a id="nav-dashboard"
                       class="nav-link {{ request()->routeIs('dashboard') || request()->routeIs('student.dashboard') || request()->routeIs('mentor.dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door me-1"></i>Dashboard
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
                                <i class="bi bi-calendar-week me-1"></i>Availability
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="nav-bookings"
                               class="nav-link {{ request()->routeIs('mentor.bookings.*') ? 'active' : '' }}"
                               href="{{ route('mentor.bookings.index') }}">
                                <i class="bi bi-calendar-check me-1"></i>Bookings
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
            <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                @auth
                    {{-- Role badge --}}
                    @php
                        $roleLabel = match(auth()->user()->role) {
                            \App\Models\User::ROLE_ADMIN   => ['Admin',   'danger'],
                            \App\Models\User::ROLE_MENTOR  => ['Mentor',  'success'],
                            default                         => ['Student', 'primary'],
                        };
                    @endphp
                    <li class="nav-item d-none d-lg-flex align-items-center me-1">
                        <span class="badge rounded-pill bg-{{ $roleLabel[1] }} bg-opacity-10 text-{{ $roleLabel[1] }} border border-{{ $roleLabel[1] }}-subtle px-2 py-1"
                              style="font-size:.72rem;font-weight:700;">
                            {{ $roleLabel[0] }}
                        </span>
                    </li>

                    {{-- User Dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle p-0 border-0 bg-transparent d-flex align-items-center" href="#"
                           id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="nav-user-chip">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4f46e5&color=fff&size=56"
                                     alt="{{ Auth::user()->name }}" class="nav-user-avatar">
                                <span class="d-none d-md-inline">{{ Str::words(Auth::user()->name, 1, '') }}</span>
                                <i class="bi bi-chevron-down" style="font-size:.7rem;"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="userDropdown">
                            <li class="px-3 pt-2 pb-1">
                                <p class="mb-0 fw-bold small text-dark">{{ Auth::user()->name }}</p>
                                <p class="mb-0 text-muted" style="font-size:.75rem;">{{ Auth::user()->email }}</p>
                            </li>
                            <li><hr class="dropdown-divider my-2"></li>
                            <li>
                                <a id="nav-profile" class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person-circle me-2 text-muted"></i>My Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" id="nav-logout"
                                            class="dropdown-item text-danger fw-medium">
                                        <i class="bi bi-box-arrow-right me-2"></i>Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Log in</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary rounded-pill px-4 ms-1" href="{{ route('register') }}">
                            Get Started
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
