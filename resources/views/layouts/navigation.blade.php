<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            <i class="bi bi-mortarboard-fill text-primary me-2"></i>MentorLink
        </a>

        <!-- Hamburger -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') || request()->routeIs('student.dashboard') || request()->routeIs('mentor.dashboard') ? 'active fw-semibold text-primary' : '' }}" href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>

                @auth
                    @if(auth()->user()->role === \App\Models\User::ROLE_STUDENT)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('student.mentors.*') ? 'active fw-semibold text-primary' : '' }}" href="{{ route('student.mentors.index') }}">
                                Find Mentors
                            </a>
                        </li>
                    @elseif(auth()->user()->role === \App\Models\User::ROLE_MENTOR)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('mentor.availabilities.*') ? 'active fw-semibold text-primary' : '' }}" href="{{ route('mentor.availabilities.index') }}">
                                Availability
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('mentor.bookings.*') ? 'active fw-semibold text-primary' : '' }}" href="{{ route('mentor.bookings.index') }}">
                                Bookings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('mentor.reviews.*') ? 'active fw-semibold text-primary' : '' }}" href="{{ route('mentor.reviews.index') }}">
                                Reviews
                            </a>
                        </li>
                    @elseif(auth()->user()->role === \App\Models\User::ROLE_ADMIN)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                Admin Panel
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            <!-- Settings Dropdown -->
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2"></i>Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
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
                        <a class="btn btn-primary rounded-pill px-3 ms-2" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
