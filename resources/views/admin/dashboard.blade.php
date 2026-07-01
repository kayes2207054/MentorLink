@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 bg-primary text-white">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-people-fill display-4 opacity-50"></i>
                </div>
                <div>
                    <h6 class="card-title text-uppercase fw-bold mb-1 opacity-75">Total Students</h6>
                    <h2 class="mb-0 fw-bold">{{ $totalStudents }}</h2>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 bg-success text-white">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-person-badge-fill display-4 opacity-50"></i>
                </div>
                <div>
                    <h6 class="card-title text-uppercase fw-bold mb-1 opacity-75">Total Mentors</h6>
                    <h2 class="mb-0 fw-bold">{{ $totalMentors }}</h2>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 bg-info text-white">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-shield-check display-4 opacity-50"></i>
                </div>
                <div>
                    <h6 class="card-title text-uppercase fw-bold mb-1 opacity-75">Verified Mentors</h6>
                    <h2 class="mb-0 fw-bold">{{ $verifiedMentors }}</h2>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 bg-warning text-dark">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-hourglass-split display-4 opacity-50"></i>
                </div>
                <div>
                    <h6 class="card-title text-uppercase fw-bold mb-1 opacity-75">Pending Requests</h6>
                    <h2 class="mb-0 fw-bold">{{ $pendingRequests }}</h2>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 bg-secondary text-white">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-building display-4 opacity-50"></i>
                </div>
                <div>
                    <h6 class="card-title text-uppercase fw-bold mb-1 opacity-75">Departments</h6>
                    <h2 class="mb-0 fw-bold">{{ $totalDepartments }}</h2>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 bg-dark text-white">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-tools display-4 opacity-50"></i>
                </div>
                <div>
                    <h6 class="card-title text-uppercase fw-bold mb-1 opacity-75">Skills</h6>
                    <h2 class="mb-0 fw-bold">{{ $totalSkills }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<h2 class="h3 mt-4 mb-3">Session Bookings</h2>
<div class="row g-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 bg-light border-start border-primary border-4">
            <div class="card-body">
                <h6 class="card-title text-uppercase fw-bold text-muted mb-2">Total Sessions</h6>
                <h2 class="display-6 fw-bold mb-0">{{ $totalSessions }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card border-0 shadow-sm h-100 bg-light border-start border-warning border-4">
            <div class="card-body">
                <h6 class="card-title text-uppercase fw-bold text-muted mb-2">Pending</h6>
                <h2 class="display-6 fw-bold mb-0">{{ $pendingSessions }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card border-0 shadow-sm h-100 bg-light border-start border-success border-4">
            <div class="card-body">
                <h6 class="card-title text-uppercase fw-bold text-muted mb-2">Accepted</h6>
                <h2 class="display-6 fw-bold mb-0">{{ $acceptedSessions }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card border-0 shadow-sm h-100 bg-light border-start border-info border-4">
            <div class="card-body">
                <h6 class="card-title text-uppercase fw-bold text-muted mb-2">Completed</h6>
                <h2 class="display-6 fw-bold mb-0">{{ $completedSessions }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 bg-light border-start border-secondary border-4">
            <div class="card-body">
                <h6 class="card-title text-uppercase fw-bold text-muted mb-2">Cancelled/Rejected</h6>
                <h2 class="display-6 fw-bold mb-0">{{ $cancelledSessions }}</h2>
            </div>
        </div>
    </div>
</div>

<h2 class="h3 mt-4 mb-3">Reviews & Ratings</h2>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 bg-dark text-white">
            <div class="card-body d-flex flex-column justify-content-center text-center">
                <i class="bi bi-star-half display-3 mb-3 text-warning"></i>
                <h5 class="card-title text-uppercase fw-bold mb-2 opacity-75">Total Reviews</h5>
                <h1 class="display-4 fw-bold mb-0">{{ $totalReviews }}</h1>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-4 pb-2">
                <h6 class="fw-bold text-success mb-0"><i class="bi bi-trophy-fill me-2"></i>Highest Rated Mentors</h6>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush border-top-0">
                    @forelse($highestRatedMentors as $mentor)
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-4 py-3">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=random" alt="{{ $mentor->name }}" class="rounded-circle me-3" width="35" height="35">
                                <span class="fw-medium">{{ $mentor->name }}</span>
                            </div>
                            <span class="badge bg-light text-dark border">
                                <i class="bi bi-star-fill text-warning me-1"></i>{{ number_format($mentor->reviews_received_avg_rating, 1) }} 
                                <span class="text-muted ms-1">({{ $mentor->reviews_received_count }})</span>
                            </span>
                        </div>
                    @empty
                        <div class="list-group-item border-0 px-4 py-3 text-muted text-center">No reviews yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-4 pb-2">
                <h6 class="fw-bold text-danger mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i>Lowest Rated Mentors</h6>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush border-top-0">
                    @forelse($lowestRatedMentors as $mentor)
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-4 py-3">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=random" alt="{{ $mentor->name }}" class="rounded-circle me-3" width="35" height="35">
                                <span class="fw-medium">{{ $mentor->name }}</span>
                            </div>
                            <span class="badge bg-light text-dark border">
                                <i class="bi bi-star-fill text-warning me-1"></i>{{ number_format($mentor->reviews_received_avg_rating, 1) }} 
                                <span class="text-muted ms-1">({{ $mentor->reviews_received_count }})</span>
                            </span>
                        </div>
                    @empty
                        <div class="list-group-item border-0 px-4 py-3 text-muted text-center">No reviews yet.</div>
                    @endforelse
                </div>
            </div>
</div>

<h2 class="h3 mt-5 mb-3">Recent Activity</h2>
<div class="row g-4 mb-4">
    <!-- Recent Users -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-4 pb-2 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="bi bi-person-plus-fill me-2 text-primary"></i>Recent Users</h6>
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-link text-decoration-none">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentUsers as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" class="rounded-circle me-2" width="30" height="30">
                                            <span class="fw-medium small">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($user->role == 'admin')
                                            <span class="badge bg-danger">Admin</span>
                                        @elseif($user->role == 'mentor')
                                            <span class="badge bg-success">Mentor</span>
                                        @else
                                            <span class="badge bg-primary">Student</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="2" class="text-center text-muted">No users found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-4 pb-2 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="bi bi-calendar-event-fill me-2 text-success"></i>Recent Bookings</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Session</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBookings as $booking)
                                <tr>
                                    <td>
                                        <div class="fw-medium small">{{ $booking->student->name }} &rarr; {{ $booking->mentor->name }}</div>
                                        <small class="text-muted">{{ $booking->booking_date->format('M d') }}</small>
                                    </td>
                                    <td>
                                        @if($booking->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($booking->status == 'accepted')
                                            <span class="badge bg-success">Accepted</span>
                                        @elseif($booking->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @elseif($booking->status == 'cancelled')
                                            <span class="badge bg-secondary">Cancelled</span>
                                        @else
                                            <span class="badge bg-primary">Completed</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="2" class="text-center text-muted">No bookings found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Reviews -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-4 pb-2 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="bi bi-chat-quote-fill me-2 text-warning"></i>Recent Reviews</h6>
                <a href="{{ route('admin.reviews.index') }}" class="btn btn-sm btn-link text-decoration-none">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Review</th>
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentReviews as $review)
                                <tr>
                                    <td>
                                        <div class="fw-medium small text-truncate" style="max-width: 150px;">{{ $review->title }}</div>
                                        <small class="text-muted">{{ $review->student->name }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            <i class="bi bi-star-fill text-warning me-1"></i>{{ $review->rating }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="2" class="text-center text-muted">No reviews found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
