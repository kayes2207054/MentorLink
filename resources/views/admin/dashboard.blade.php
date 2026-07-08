@extends('layouts.admin')

@section('content')

{{-- Page Title --}}
<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-soft">
    <div>
        <h4 class="fw-bold mb-0">Platform Overview</h4>
        <p class="text-muted small mb-0">Real-time snapshot of MentorLink activity</p>
    </div>
    <span class="badge rounded-pill px-3 py-2" style="background:#ede9fe;color:#4f46e5;font-weight:700;font-size:.75rem;">
        <i class="bi bi-circle-fill me-1" style="font-size:.5rem;"></i>Live Dashboard
    </span>
</div>

{{-- =============================================
     SECTION: USER OVERVIEW
     ============================================= --}}
<h6 class="section-title mb-3">Users &amp; Mentors</h6>
<div class="row g-3 mb-4 fade-in-stagger">

    <div class="col-6 col-md-4 col-lg-2">
        <div class="stat-card-colored card text-white h-100" style="background:linear-gradient(135deg,#4f46e5 0%,#7c3aed 100%);">
            <div class="card-body py-3 px-3">
                <i class="bi bi-people display-5 opacity-25 position-absolute" style="right:.75rem;top:.5rem;"></i>
                <p class="text-uppercase fw-bold mb-1 opacity-75" style="font-size:.65rem;letter-spacing:.08em;">Total Users</p>
                <h2 class="mb-0 fw-bold">{{ $totalUsers }}</h2>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-4 col-lg-2">
        <div class="stat-card-colored card text-white h-100" style="background:linear-gradient(135deg,#0891b2 0%,#06b6d4 100%);">
            <div class="card-body py-3 px-3">
                <i class="bi bi-person-check display-5 opacity-25 position-absolute" style="right:.75rem;top:.5rem;"></i>
                <p class="text-uppercase fw-bold mb-1 opacity-75" style="font-size:.65rem;letter-spacing:.08em;">Active Users</p>
                <h2 class="mb-0 fw-bold">{{ $activeUsers }}</h2>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-4 col-lg-2">
        <div class="stat-card-colored card text-white h-100" style="background:linear-gradient(135deg,#1d4ed8 0%,#3b82f6 100%);">
            <div class="card-body py-3 px-3">
                <i class="bi bi-mortarboard display-5 opacity-25 position-absolute" style="right:.75rem;top:.5rem;"></i>
                <p class="text-uppercase fw-bold mb-1 opacity-75" style="font-size:.65rem;letter-spacing:.08em;">Students</p>
                <h2 class="mb-0 fw-bold">{{ $totalStudents }}</h2>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-4 col-lg-2">
        <div class="stat-card-colored card text-white h-100" style="background:linear-gradient(135deg,#059669 0%,#10b981 100%);">
            <div class="card-body py-3 px-3">
                <i class="bi bi-person-badge display-5 opacity-25 position-absolute" style="right:.75rem;top:.5rem;"></i>
                <p class="text-uppercase fw-bold mb-1 opacity-75" style="font-size:.65rem;letter-spacing:.08em;">Mentors</p>
                <h2 class="mb-0 fw-bold">{{ $totalMentors }}</h2>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-4 col-lg-2">
        <div class="stat-card-colored card text-white h-100" style="background:linear-gradient(135deg,#0e7490 0%,#06b6d4 100%);">
            <div class="card-body py-3 px-3">
                <i class="bi bi-shield-check display-5 opacity-25 position-absolute" style="right:.75rem;top:.5rem;"></i>
                <p class="text-uppercase fw-bold mb-1 opacity-75" style="font-size:.65rem;letter-spacing:.08em;">Verified</p>
                <h2 class="mb-0 fw-bold">{{ $verifiedMentors }}</h2>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-4 col-lg-2">
        <div class="stat-card-colored card text-white h-100" style="background:linear-gradient(135deg,#d97706 0%,#f59e0b 100%);">
            <div class="card-body py-3 px-3">
                <i class="bi bi-star-fill display-5 opacity-25 position-absolute" style="right:.75rem;top:.5rem;"></i>
                <p class="text-uppercase fw-bold mb-1 opacity-75" style="font-size:.65rem;letter-spacing:.08em;">Avg Rating</p>
                <h2 class="mb-0 fw-bold">{{ number_format($averagePlatformRating, 1) }}</h2>
            </div>
        </div>
    </div>

</div>

{{-- =============================================
     SECTION: REQUESTS & CONTENT
     ============================================= --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left:4px solid #4f46e5 !important;border-radius:.75rem !important;">
            <div class="card-body py-3 px-3">
                <p class="text-uppercase fw-bold text-muted mb-1" style="font-size:.65rem;letter-spacing:.08em;">Total Requests</p>
                <h2 class="mb-0 fw-bold text-gradient-primary">{{ $totalRequests }}</h2>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left:4px solid #f59e0b !important;border-radius:.75rem !important;">
            <div class="card-body py-3 px-3">
                <p class="text-uppercase fw-bold text-muted mb-1" style="font-size:.65rem;letter-spacing:.08em;">Pending Requests</p>
                <h2 class="mb-0 fw-bold" style="color:#d97706;">{{ $pendingRequests }}</h2>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left:4px solid #10b981 !important;border-radius:.75rem !important;">
            <div class="card-body py-3 px-3">
                <p class="text-uppercase fw-bold text-muted mb-1" style="font-size:.65rem;letter-spacing:.08em;">Departments</p>
                <h2 class="mb-0 fw-bold" style="color:#059669;">{{ $totalDepartments }}</h2>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left:4px solid #6366f1 !important;border-radius:.75rem !important;">
            <div class="card-body py-3 px-3">
                <p class="text-uppercase fw-bold text-muted mb-1" style="font-size:.65rem;letter-spacing:.08em;">Skills</p>
                <h2 class="mb-0 fw-bold" style="color:#4f46e5;">{{ $totalSkills }}</h2>
            </div>
        </div>
    </div>
</div>

{{-- =============================================
     SECTION: SESSION BOOKINGS
     ============================================= --}}
<h6 class="section-title mb-3 mt-4">Session Bookings</h6>
<div class="row g-3 mb-5">
    <div class="col-6 col-md">
        <div class="card border-0 shadow-sm h-100 text-center" style="border-radius:.75rem!important;">
            <div class="card-body py-3">
                <p class="text-muted text-uppercase fw-bold mb-1" style="font-size:.65rem;letter-spacing:.08em;">Total</p>
                <h3 class="fw-bold mb-0">{{ $totalSessions }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-md">
        <div class="card border-0 shadow-sm h-100 text-center" style="border-radius:.75rem!important;">
            <div class="card-body py-3">
                <p class="text-muted text-uppercase fw-bold mb-1" style="font-size:.65rem;letter-spacing:.08em;">Pending</p>
                <h3 class="fw-bold mb-0" style="color:#d97706;">{{ $pendingSessions }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-md">
        <div class="card border-0 shadow-sm h-100 text-center" style="border-radius:.75rem!important;">
            <div class="card-body py-3">
                <p class="text-muted text-uppercase fw-bold mb-1" style="font-size:.65rem;letter-spacing:.08em;">Accepted</p>
                <h3 class="fw-bold mb-0" style="color:#059669;">{{ $acceptedSessions }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-md">
        <div class="card border-0 shadow-sm h-100 text-center" style="border-radius:.75rem!important;">
            <div class="card-body py-3">
                <p class="text-muted text-uppercase fw-bold mb-1" style="font-size:.65rem;letter-spacing:.08em;">Completed</p>
                <h3 class="fw-bold mb-0" style="color:#4f46e5;">{{ $completedSessions }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-md">
        <div class="card border-0 shadow-sm h-100 text-center" style="border-radius:.75rem!important;">
            <div class="card-body py-3">
                <p class="text-muted text-uppercase fw-bold mb-1" style="font-size:.65rem;letter-spacing:.08em;">Cancelled</p>
                <h3 class="fw-bold mb-0 text-muted">{{ $cancelledSessions }}</h3>
            </div>
        </div>
    </div>
</div>

{{-- =============================================
     SECTION: REVIEWS & RATINGS
     ============================================= --}}
<h6 class="section-title mb-3">Reviews &amp; Ratings</h6>
<div class="row g-4 mb-5">

    {{-- Total Reviews --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 text-center overflow-hidden" style="border-radius:1rem!important;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center py-4"
                 style="background:linear-gradient(135deg,#1e293b 0%,#334155 100%);">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:60px;height:60px;background:rgba(245,158,11,.2);">
                    <i class="bi bi-star-fill text-warning fs-3"></i>
                </div>
                <p class="text-uppercase fw-bold mb-2 text-white opacity-75" style="font-size:.7rem;letter-spacing:.08em;">
                    Total Reviews
                </p>
                <h1 class="display-5 fw-bold text-white mb-0">{{ $totalReviews }}</h1>
            </div>
        </div>
    </div>

    {{-- Highest Rated --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius:1rem!important;">
            <div class="card-header bg-white border-bottom border-soft px-4 pt-3 pb-2">
                <h6 class="fw-bold mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-trophy-fill text-warning"></i> Highest Rated Mentors
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($highestRatedMentors as $mentor)
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-4 py-3">
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=random&size=60"
                                     alt="{{ $mentor->name }}" class="rounded-circle" width="34" height="34">
                                <span class="fw-medium small">{{ $mentor->name }}</span>
                            </div>
                            <span class="badge rounded-pill px-2 py-1"
                                  style="background:#d1fae5;color:#065f46;font-weight:700;font-size:.72rem;">
                                <i class="bi bi-star-fill me-1" style="color:#f59e0b;"></i>
                                {{ number_format($mentor->reviews_received_avg_rating, 1) }}
                                <span class="text-muted ms-1">({{ $mentor->reviews_received_count }})</span>
                            </span>
                        </div>
                    @empty
                        <div class="list-group-item border-0 px-4 py-4 text-center text-muted small">
                            No reviews yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Lowest Rated --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius:1rem!important;">
            <div class="card-header bg-white border-bottom border-soft px-4 pt-3 pb-2">
                <h6 class="fw-bold mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill text-danger"></i> Lowest Rated Mentors
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($lowestRatedMentors as $mentor)
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-4 py-3">
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=random&size=60"
                                     alt="{{ $mentor->name }}" class="rounded-circle" width="34" height="34">
                                <span class="fw-medium small">{{ $mentor->name }}</span>
                            </div>
                            <span class="badge rounded-pill px-2 py-1"
                                  style="background:#fee2e2;color:#991b1b;font-weight:700;font-size:.72rem;">
                                <i class="bi bi-star-fill me-1" style="color:#f59e0b;"></i>
                                {{ number_format($mentor->reviews_received_avg_rating, 1) }}
                                <span class="text-muted ms-1">({{ $mentor->reviews_received_count }})</span>
                            </span>
                        </div>
                    @empty
                        <div class="list-group-item border-0 px-4 py-4 text-center text-muted small">
                            No reviews yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>

{{-- =============================================
     SECTION: RECENT ACTIVITY
     ============================================= --}}
<h6 class="section-title mb-3">Recent Activity</h6>
<div class="row g-4 mb-4">

    {{-- Recent Users --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius:1rem!important;">
            <div class="card-header bg-white border-bottom border-soft px-4 pt-3 pb-2 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-person-plus-fill text-primary"></i> Recent Users
                </h6>
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm rounded-pill"
                   style="background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0;font-size:.75rem;font-weight:600;">
                    View All
                </a>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($recentUsers as $user)
                        <div class="list-group-item border-0 px-4 py-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=60"
                                     class="rounded-circle" width="32" height="32" alt="{{ $user->name }}">
                                <span class="fw-medium small">{{ $user->name }}</span>
                            </div>
                            @if($user->role == 'admin')
                                <span class="badge rounded-pill px-2 py-1" style="background:#fee2e2;color:#991b1b;font-size:.7rem;">Admin</span>
                            @elseif($user->role == 'mentor')
                                <span class="badge rounded-pill px-2 py-1" style="background:#d1fae5;color:#065f46;font-size:.7rem;">Mentor</span>
                            @else
                                <span class="badge rounded-pill px-2 py-1" style="background:#dbeafe;color:#1e40af;font-size:.7rem;">Student</span>
                            @endif
                        </div>
                    @empty
                        <div class="list-group-item border-0 px-4 py-4 text-center text-muted small">No users found.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Bookings --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius:1rem!important;">
            <div class="card-header bg-white border-bottom border-soft px-4 pt-3 pb-2">
                <h6 class="fw-bold mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-calendar-event-fill text-success"></i> Recent Bookings
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($recentBookings as $booking)
                        <div class="list-group-item border-0 px-4 py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-medium small">{{ $booking->student->name }} &rarr; {{ $booking->mentor->name }}</div>
                                <small class="text-muted">{{ $booking->booking_date->format('M d, Y') }}</small>
                            </div>
                            @if($booking->status == 'pending')
                                <span class="badge badge-status-pending rounded-pill px-2">Pending</span>
                            @elseif($booking->status == 'accepted')
                                <span class="badge badge-status-accepted rounded-pill px-2">Accepted</span>
                            @elseif($booking->status == 'rejected')
                                <span class="badge badge-status-rejected rounded-pill px-2">Rejected</span>
                            @elseif($booking->status == 'cancelled')
                                <span class="badge badge-status-cancelled rounded-pill px-2">Cancelled</span>
                            @else
                                <span class="badge badge-status-completed rounded-pill px-2">Completed</span>
                            @endif
                        </div>
                    @empty
                        <div class="list-group-item border-0 px-4 py-4 text-center text-muted small">No bookings found.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Reviews --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius:1rem!important;">
            <div class="card-header bg-white border-bottom border-soft px-4 pt-3 pb-2 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-chat-quote-fill text-warning"></i> Recent Reviews
                </h6>
                <a href="{{ route('admin.reviews.index') }}" class="btn btn-sm rounded-pill"
                   style="background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0;font-size:.75rem;font-weight:600;">
                    View All
                </a>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($recentReviews as $review)
                        <div class="list-group-item border-0 px-4 py-3 d-flex justify-content-between align-items-center">
                            <div style="min-width:0;">
                                <div class="fw-medium small text-truncate">{{ $review->title }}</div>
                                <small class="text-muted">{{ $review->student->name }}</small>
                            </div>
                            <span class="badge rounded-pill px-2 py-1 ms-2 flex-shrink-0"
                                  style="background:#fef3c7;color:#92400e;font-weight:700;font-size:.72rem;">
                                <i class="bi bi-star-fill me-1" style="color:#f59e0b;"></i>{{ $review->rating }}
                            </span>
                        </div>
                    @empty
                        <div class="list-group-item border-0 px-4 py-4 text-center text-muted small">No reviews found.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
