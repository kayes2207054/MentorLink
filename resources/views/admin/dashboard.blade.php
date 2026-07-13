@extends('layouts.admin')
@section('content')

{{-- Dashboard Header --}}
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5 pb-3 border-bottom border-soft gap-3">
    <div>
        <h2 class="fw-bold font-heading text-white mb-1">Platform Overview</h2>
        <p class="text-muted mb-0">Real-time metrics and system health</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-bold d-flex align-items-center gap-1">
            <i class="bi bi-people-fill"></i> Manage Users
        </a>
        <a href="{{ route('admin.mentors.index') }}" class="btn btn-primary btn-sm rounded-pill px-3 fw-bold d-flex align-items-center gap-1">
            <i class="bi bi-patch-check-fill"></i> Review Mentors
        </a>
    </div>
</div>

{{-- Primary Stat Cards --}}
<div class="row g-4 mb-5 fade-in-stagger">
    <div class="col-xl-3 col-sm-6">
        <div class="card dash-stat-card border-0 h-100" style="--dash-gradient: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="bi bi-people-fill dash-stat-bg-icon"></i>
                <div class="dash-stat-icon-wrap mb-3">
                    <i class="bi bi-people-fill"></i>
                </div>
                <p class="text-uppercase fw-bold mb-1 text-white-50 small tracking-wide">Total Users</p>
                <h2 class="display-5 fw-bold mb-0 text-white">{{ $totalUsers }}</h2>
                <div class="mt-2">
                    <span class="badge bg-white bg-opacity-25 text-white small fw-semibold">{{ $activeUsers }} active</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card dash-stat-card border-0 h-100" style="--dash-gradient: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="bi bi-mortarboard-fill dash-stat-bg-icon"></i>
                <div class="dash-stat-icon-wrap mb-3">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <p class="text-uppercase fw-bold mb-1 text-white-50 small tracking-wide">Active Students</p>
                <h2 class="display-5 fw-bold mb-0 text-white">{{ $totalStudents }}</h2>
                <div class="mt-2">
                    <span class="badge bg-white bg-opacity-25 text-white small fw-semibold">{{ $totalMentors }} mentors</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card dash-stat-card border-0 h-100" style="--dash-gradient: linear-gradient(135deg, #10b981 0%, #047857 100%);">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="bi bi-person-badge-fill dash-stat-bg-icon"></i>
                <div class="dash-stat-icon-wrap mb-3">
                    <i class="bi bi-person-badge-fill"></i>
                </div>
                <p class="text-uppercase fw-bold mb-1 text-white-50 small tracking-wide">Verified Mentors</p>
                <h2 class="display-5 fw-bold mb-0 text-white">{{ $verifiedMentors }}</h2>
                <div class="mt-2">
                    <span class="badge bg-white bg-opacity-25 text-white small fw-semibold">of {{ $totalMentors }} total</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card dash-stat-card border-0 h-100" style="--dash-gradient: linear-gradient(135deg, #f59e0b 0%, #b45309 100%);">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="bi bi-star-fill dash-stat-bg-icon"></i>
                <div class="dash-stat-icon-wrap mb-3">
                    <i class="bi bi-star-fill"></i>
                </div>
                <p class="text-uppercase fw-bold mb-1 text-white-50 small tracking-wide">Avg Platform Rating</p>
                <h2 class="display-5 fw-bold mb-0 text-white">{{ number_format($averagePlatformRating, 1) }}</h2>
                <div class="mt-2">
                    <span class="badge bg-white bg-opacity-25 text-white small fw-semibold">{{ $totalReviews }} reviews</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Session Pipeline & Catalog --}}
<div class="row g-4 mb-5 fade-in-stagger">
    <div class="col-lg-8">
        <div class="card card-elevated h-100 border-0">
            <div class="card-header bg-transparent border-bottom border-soft p-4 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="dash-section-icon bg-primary">
                        <i class="bi bi-activity"></i>
                    </div>
                    <h5 class="mb-0 fw-bold font-heading">Session Pipeline</h5>
                </div>
                <span class="badge bg-primary bg-opacity-15 text-primary fw-semibold">{{ $totalSessions }} total</span>
            </div>
            <div class="card-body p-4">
                {{-- Session status breakdown --}}
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="dash-mini-stat">
                            <div class="dash-mini-dot" style="background: var(--ml-warning);"></div>
                            <div>
                                <span class="d-block text-muted small fw-semibold">Pending</span>
                                <span class="fw-bold text-white fs-5">{{ $pendingSessions }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="dash-mini-stat">
                            <div class="dash-mini-dot" style="background: var(--ml-accent);"></div>
                            <div>
                                <span class="d-block text-muted small fw-semibold">Accepted</span>
                                <span class="fw-bold text-white fs-5">{{ $acceptedSessions }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="dash-mini-stat">
                            <div class="dash-mini-dot" style="background: var(--ml-success);"></div>
                            <div>
                                <span class="d-block text-muted small fw-semibold">Completed</span>
                                <span class="fw-bold text-success fs-5">{{ $completedSessions }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="dash-mini-stat">
                            <div class="dash-mini-dot" style="background: var(--ml-danger);"></div>
                            <div>
                                <span class="d-block text-muted small fw-semibold">Cancelled</span>
                                <span class="fw-bold text-danger fs-5">{{ $cancelledSessions }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Visual bar --}}
                @if($totalSessions > 0)
                <div class="dash-pipeline-bar mb-3">
                    <div class="dash-pipeline-segment" style="width: {{ ($pendingSessions / $totalSessions) * 100 }}%; background: var(--ml-warning);" title="Pending: {{ $pendingSessions }}"></div>
                    <div class="dash-pipeline-segment" style="width: {{ ($acceptedSessions / $totalSessions) * 100 }}%; background: var(--ml-accent);" title="Accepted: {{ $acceptedSessions }}"></div>
                    <div class="dash-pipeline-segment" style="width: {{ ($completedSessions / $totalSessions) * 100 }}%; background: var(--ml-success);" title="Completed: {{ $completedSessions }}"></div>
                    <div class="dash-pipeline-segment" style="width: {{ ($cancelledSessions / $totalSessions) * 100 }}%; background: var(--ml-danger);" title="Cancelled: {{ $cancelledSessions }}"></div>
                </div>
                @endif

                <hr class="border-soft my-4">

                {{-- Mentorship requests --}}
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase tracking-wide">Mentorship Requests</span>
                        <h4 class="fw-bold text-white mb-0 mt-1">{{ $totalRequests }}</h4>
                    </div>
                    @if($pendingRequests > 0)
                    <span class="badge bg-warning bg-opacity-15 text-warning fw-bold px-3 py-2">
                        <i class="bi bi-hourglass-split me-1"></i> {{ $pendingRequests }} pending
                    </span>
                    @else
                    <span class="badge bg-success bg-opacity-15 text-success fw-bold px-3 py-2">
                        <i class="bi bi-check-circle me-1"></i> All clear
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-elevated h-100 border-0 dash-catalog-card overflow-hidden">
            <div class="card-body p-4 position-relative z-1 d-flex flex-column justify-content-center align-items-center text-center">
                <div class="dash-catalog-icon mb-3">
                    <i class="bi bi-building fs-1"></i>
                </div>
                <h4 class="font-heading fw-bold mb-1 text-white">{{ $totalDepartments }} Departments</h4>
                <p class="text-muted mb-2">{{ $totalSkills }} Registered Skills</p>
                <div class="d-flex gap-2 mt-2">
                    <a href="{{ route('admin.departments.index') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-bold">
                        <i class="bi bi-building me-1"></i> Departments
                    </a>
                    <a href="{{ route('admin.skills.index') }}" class="btn btn-primary btn-sm rounded-pill px-3 fw-bold">
                        <i class="bi bi-lightning-charge me-1"></i> Skills
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Top Mentors & Recent Activity --}}
<div class="row g-4 mb-5 fade-in-stagger">
    {{-- Top Rated Mentors --}}
    <div class="col-lg-6">
        <div class="card card-elevated h-100 border-0">
            <div class="card-header bg-transparent border-bottom border-soft p-4 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="dash-section-icon bg-warning">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <h5 class="mb-0 fw-bold font-heading">Top Rated Mentors</h5>
                </div>
            </div>
            <div class="card-body p-0">
                @forelse($highestRatedMentors as $mentor)
                <div class="dash-list-item">
                    <div class="d-flex align-items-center gap-3 flex-grow-1 min-w-0">
                        <div class="dash-avatar" style="background: linear-gradient(135deg, var(--ml-primary), var(--ml-accent));">
                            {{ strtoupper(substr($mentor->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <h6 class="fw-bold text-white mb-0 text-truncate">{{ $mentor->name }}</h6>
                            <small class="text-muted">{{ $mentor->reviews_received_count }} reviews</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-1 text-warning fw-bold">
                        <i class="bi bi-star-fill small"></i>
                        {{ number_format($mentor->reviews_received_avg_rating, 1) }}
                    </div>
                </div>
                @empty
                <div class="dash-empty-state">
                    <i class="bi bi-trophy text-muted fs-1 mb-2 d-block opacity-50"></i>
                    <p class="text-muted mb-0 small">No mentor ratings yet</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Recent Signups --}}
    <div class="col-lg-6">
        <div class="card card-elevated h-100 border-0">
            <div class="card-header bg-transparent border-bottom border-soft p-4 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="dash-section-icon bg-success">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h5 class="mb-0 fw-bold font-heading">Recent Signups</h5>
                </div>
                <a href="{{ route('admin.users.index') }}" class="text-primary text-decoration-none small fw-semibold">View all <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="card-body p-0">
                @forelse($recentUsers as $user)
                <div class="dash-list-item">
                    <div class="d-flex align-items-center gap-3 flex-grow-1 min-w-0">
                        <div class="dash-avatar" style="background: linear-gradient(135deg, {{ $user->role === 'mentor' ? '#10b981, #047857' : '#6366f1, #4338ca' }});">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <h6 class="fw-bold text-white mb-0 text-truncate">{{ $user->name }}</h6>
                            <small class="text-muted">{{ $user->email }}</small>
                        </div>
                    </div>
                    <span class="badge {{ $user->role === 'admin' ? 'badge-status-completed' : ($user->role === 'mentor' ? 'badge-status-accepted' : 'badge-status-pending') }} text-capitalize">{{ $user->role }}</span>
                </div>
                @empty
                <div class="dash-empty-state">
                    <i class="bi bi-people text-muted fs-1 mb-2 d-block opacity-50"></i>
                    <p class="text-muted mb-0 small">No users yet</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Recent Bookings & Reviews --}}
<div class="row g-4 fade-in-stagger">
    {{-- Recent Bookings --}}
    <div class="col-lg-6">
        <div class="card card-elevated h-100 border-0">
            <div class="card-header bg-transparent border-bottom border-soft p-4 d-flex align-items-center">
                <div class="dash-section-icon bg-info">
                    <i class="bi bi-calendar2-check-fill"></i>
                </div>
                <h5 class="mb-0 fw-bold font-heading">Recent Bookings</h5>
            </div>
            <div class="card-body p-0">
                @forelse($recentBookings as $booking)
                <div class="dash-list-item">
                    <div class="d-flex align-items-center gap-3 flex-grow-1 min-w-0">
                        <div class="dash-avatar dash-avatar-sm" style="background: linear-gradient(135deg, var(--ml-accent), #0369a1);">
                            <i class="bi bi-calendar-event small"></i>
                        </div>
                        <div class="min-w-0">
                            <h6 class="fw-semibold text-white mb-0 small text-truncate">
                                {{ $booking->student->name ?? 'N/A' }} → {{ $booking->mentor->name ?? 'N/A' }}
                            </h6>
                            <small class="text-muted">{{ $booking->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    <span class="badge badge-status-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                </div>
                @empty
                <div class="dash-empty-state">
                    <i class="bi bi-calendar-x text-muted fs-1 mb-2 d-block opacity-50"></i>
                    <p class="text-muted mb-0 small">No bookings yet</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Recent Reviews --}}
    <div class="col-lg-6">
        <div class="card card-elevated h-100 border-0">
            <div class="card-header bg-transparent border-bottom border-soft p-4 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="dash-section-icon bg-warning">
                        <i class="bi bi-chat-square-heart-fill"></i>
                    </div>
                    <h5 class="mb-0 fw-bold font-heading">Recent Reviews</h5>
                </div>
                <a href="{{ route('admin.reviews.index') }}" class="text-primary text-decoration-none small fw-semibold">View all <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="card-body p-0">
                @forelse($recentReviews as $review)
                <div class="dash-list-item">
                    <div class="d-flex align-items-center gap-3 flex-grow-1 min-w-0">
                        <div class="dash-avatar dash-avatar-sm" style="background: linear-gradient(135deg, var(--ml-warning), #b45309);">
                            <i class="bi bi-star-fill small"></i>
                        </div>
                        <div class="min-w-0">
                            <h6 class="fw-semibold text-white mb-0 small text-truncate">
                                {{ $review->student->name ?? 'N/A' }} reviewed {{ $review->mentor->name ?? 'N/A' }}
                            </h6>
                            <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-1 text-warning fw-bold small">
                        <i class="bi bi-star-fill"></i> {{ $review->rating }}
                    </div>
                </div>
                @empty
                <div class="dash-empty-state">
                    <i class="bi bi-chat-square-heart text-muted fs-1 mb-2 d-block opacity-50"></i>
                    <p class="text-muted mb-0 small">No reviews yet</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
