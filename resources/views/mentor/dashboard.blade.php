<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mentor Dashboard') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bootstrap-wrapper { font-family: 'Inter', sans-serif; }
        .bootstrap-wrapper .card { transition: transform 0.2s, box-shadow 0.2s; border-radius: 0.75rem; }
        .bootstrap-wrapper .card:hover { transform: translateY(-3px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bootstrap-wrapper">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Dashboard Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0 text-gray-800">Mentor Dashboard</h3>
                <div class="d-flex gap-2">
                    <a href="{{ route('mentor.availabilities.index') }}" class="btn btn-primary shadow-sm hover-lift-btn"><i class="bi bi-calendar-plus me-1"></i> Manage Availability</a>
                    <a href="{{ route('mentor.bookings.index') }}" class="btn btn-outline-secondary shadow-sm hover-lift-btn">All Bookings</a>
                </div>
            </div>

            <!-- Mentorship & Activity Stats -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold mb-0 text-gray-800">Mentorship Activity</h4>
            </div>
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <x-stat-card title="Total Requests" :value="$totalRequests" icon="inbox" color="primary" />
                </div>
                <div class="col-md-4">
                    <x-stat-card title="Pending Requests" :value="$pendingRequests->count()" icon="hourglass" color="warning" />
                </div>
                <div class="col-md-4">
                    <x-stat-card title="Availability Slots" :value="$availabilitySlotCount" icon="clock-history" color="success" />
                </div>
            </div>

            <!-- Bookings Stats Row -->
            <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                <h4 class="fw-bold mb-0 text-gray-800">Session Bookings</h4>
            </div>
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <x-stat-card title="Today" :value="$todayBookings->count()" icon="calendar-day" color="primary" />
                </div>
                <div class="col-md-3">
                    <x-stat-card title="Upcoming" :value="$upcomingBookings->count()" icon="calendar-event" color="success" />
                </div>
                <div class="col-md-3">
                    <x-stat-card title="Pending" :value="$pendingBookings->count()" icon="hourglass-split" color="warning" />
                </div>
                <div class="col-md-3">
                    <x-stat-card title="Completed" :value="$completedBookings->count()" icon="check-circle" color="info" />
                </div>
            </div>

            <div class="row g-4">
                <!-- Mentorship Requests -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100 rounded-4 hover-lift">
                        <div class="card-body p-4">
                            <h4 class="mb-4 fw-bold">Mentorship Requests</h4>
                            
                            <ul class="nav nav-pills mb-3 border-bottom pb-2" id="requests-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active rounded-pill fw-medium" id="pending-tab" data-bs-toggle="pill" data-bs-target="#pending" type="button" role="tab">Pending <span class="badge bg-warning text-dark ms-1">{{ $pendingRequests->count() }}</span></button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded-pill fw-medium" id="accepted-tab" data-bs-toggle="pill" data-bs-target="#accepted" type="button" role="tab">Accepted</button>
                                </li>
                            </ul>
                            
                            <div class="tab-content" id="requests-tabContent">
                                <!-- Pending Requests -->
                                <div class="tab-pane fade show active" id="pending" role="tabpanel">
                                    @if($pendingRequests->count() > 0)
                                        <div class="list-group list-group-flush border-top-0">
                                            @foreach($pendingRequests as $request)
                                                <div class="list-group-item border-start-0 border-end-0 px-0 py-3">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div class="d-flex align-items-center">
                                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($request->student->name) }}&background=random" class="rounded-circle me-3" width="40" height="40" alt="{{ $request->student->name }}">
                                                            <div>
                                                                <h6 class="fw-bold mb-1">{{ $request->student->name }}</h6>
                                                                <p class="text-muted small mb-0 fst-italic">"{{ Str::limit($request->message, 60) }}"</p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex gap-2 ms-2">
                                                            <form method="POST" action="{{ route('mentor.mentorship-requests.update', $request) }}">
                                                                @csrf @method('PATCH')
                                                                <input type="hidden" name="status" value="accepted">
                                                                <button type="submit" class="btn btn-outline-success btn-sm rounded-pill"><i class="bi bi-check-lg"></i></button>
                                                            </form>
                                                            <form method="POST" action="{{ route('mentor.mentorship-requests.update', $request) }}">
                                                                @csrf @method('PATCH')
                                                                <input type="hidden" name="status" value="rejected">
                                                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-x-lg"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-5">
                                            <div class="bg-light rounded-circle d-inline-flex mx-auto p-4 mb-3">
                                                <i class="bi bi-inbox fs-2 text-muted"></i>
                                            </div>
                                            <h6 class="fw-bold text-muted">No pending requests</h6>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Accepted Requests -->
                                <div class="tab-pane fade" id="accepted" role="tabpanel">
                                    @if($acceptedRequests->count() > 0)
                                        <div class="list-group list-group-flush border-top-0">
                                            @foreach($acceptedRequests as $request)
                                                <div class="list-group-item border-start-0 border-end-0 px-0 py-3">
                                                    <div class="d-flex align-items-center">
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($request->student->name) }}&background=random" class="rounded-circle me-3" width="40" height="40" alt="{{ $request->student->name }}">
                                                        <div>
                                                            <h6 class="fw-bold mb-1">{{ $request->student->name }}</h6>
                                                            <p class="text-muted small mb-0 fst-italic">"{{ Str::limit($request->message, 60) }}"</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center text-muted py-5">No accepted requests yet.</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100 rounded-4 hover-lift">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="mb-0 fw-bold">Recent Reviews</h4>
                                <a href="{{ route('mentor.reviews.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill hover-lift-btn">View All</a>
                            </div>
                            
                            <div class="d-flex align-items-center mb-4 p-4 bg-light rounded-4 shadow-sm border border-light">
                                <div class="me-4 text-center">
                                    <h1 class="mb-0 fw-bold text-warning display-4">{{ number_format($averageRating, 1) }}</h1>
                                </div>
                                <div>
                                    <div class="text-warning fs-5 mb-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($averageRating))
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-muted fw-medium">Based on {{ $totalReviews }} review(s)</span>
                                </div>
                            </div>
                            
                            @if(isset($reviews) && $reviews->count() > 0)
                                <div class="list-group list-group-flush border-top-0">
                                    @foreach($reviews as $review)
                                        <div class="list-group-item border-start-0 border-end-0 px-0 py-3">
                                            <div class="d-flex justify-content-between mb-1">
                                                <h6 class="mb-0 fw-bold">{{ $review->title }}</h6>
                                                <small class="text-muted bg-light px-2 py-1 rounded">{{ $review->created_at->diffForHumans() }}</small>
                                            </div>
                                            <div class="text-warning small mb-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                                @endfor
                                            </div>
                                            <p class="mb-2 small text-secondary">"{{ $review->comment }}"</p>
                                            <div class="d-flex align-items-center">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($review->student->name) }}&background=random" class="rounded-circle me-2" width="20" height="20" alt="{{ $review->student->name }}">
                                                <small class="text-muted fw-bold">{{ $review->student->name }}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <div class="bg-light rounded-circle d-inline-flex mx-auto p-4 mb-3">
                                        <i class="bi bi-star fs-2 text-warning"></i>
                                    </div>
                                    <h6 class="fw-bold text-muted">No reviews received yet</h6>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    <!-- Include Bootstrap JS for Tabs -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
