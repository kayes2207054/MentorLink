<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bootstrap-wrapper">
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4 rounded-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Mentorship Requests Stats -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold mb-0 text-gray-800">Mentorship Requests</h4>
                <a href="{{ route('student.mentors.index') }}" class="btn btn-primary shadow-sm hover-lift-btn rounded-pill px-4"><i class="bi bi-search me-2"></i>Find a Mentor</a>
            </div>
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <x-stat-card title="Total Sent" :value="$totalRequests" icon="send" color="primary" />
                </div>
                <div class="col-md-3">
                    <x-stat-card title="Pending" :value="$pendingRequests" icon="hourglass" color="warning" />
                </div>
                <div class="col-md-3">
                    <x-stat-card title="Accepted" :value="$acceptedRequests" icon="check-circle" color="success" />
                </div>
                <div class="col-md-3">
                    <x-stat-card title="Pending Reviews" :value="$pendingReviewsCount" icon="star-half" color="info" />
                </div>
            </div>

            <!-- Dashboard Header (Bookings) -->
            <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                <h4 class="fw-bold mb-0 text-gray-800">My Bookings</h4>
            </div>

            <!-- Stats Row -->
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <x-stat-card title="Upcoming" :value="$upcomingBookings->count()" icon="calendar-event" color="success" />
                </div>
                <div class="col-md-3">
                    <x-stat-card title="Pending" :value="$pendingBookings->count()" icon="hourglass-split" color="warning" />
                </div>
                <div class="col-md-3">
                    <x-stat-card title="Completed" :value="$completedBookings->count()" icon="check-circle" color="primary" />
                </div>
                <div class="col-md-3">
                    <x-stat-card title="Cancelled" :value="$cancelledBookings->count()" icon="x-circle" color="secondary" />
                </div>
            </div>

            <!-- Recent Bookings Table -->
            <div class="card border-0 shadow-sm mb-5 rounded-4 overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Recent Bookings</h5>
                    @if($bookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-muted text-uppercase small tracking-wide">
                                    <tr>
                                        <th class="ps-3 border-bottom-0 rounded-start">Mentor</th>
                                        <th class="border-bottom-0">Date & Time</th>
                                        <th class="border-bottom-0">Status</th>
                                        <th class="text-end pe-3 border-bottom-0 rounded-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings->take(5) as $booking)
                                        <tr>
                                            <td class="ps-3">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($booking->mentor->name) }}&background=random" class="rounded-circle me-3 border border-2 border-white shadow-sm" width="40" height="40" alt="{{ $booking->mentor->name }}">
                                                    <span class="fw-medium">{{ $booking->mentor->name }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fw-medium">{{ $booking->booking_date->format('M d, Y') }}</div>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($booking->availability->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($booking->availability->end_time)->format('h:i A') }}
                                                </small>
                                            </td>
                                            <td>
                                                @if($booking->status == 'pending')
                                                    <span class="badge bg-warning text-dark bg-opacity-25 border border-warning rounded-pill px-3 py-2"><i class="bi bi-clock me-1"></i>Pending</span>
                                                @elseif($booking->status == 'accepted')
                                                    <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3 py-2"><i class="bi bi-check-circle me-1"></i>Accepted</span>
                                                @elseif($booking->status == 'rejected')
                                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger rounded-pill px-3 py-2"><i class="bi bi-x-circle me-1"></i>Rejected</span>
                                                @elseif($booking->status == 'cancelled')
                                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary rounded-pill px-3 py-2"><i class="bi bi-slash-circle me-1"></i>Cancelled</span>
                                                @else
                                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary rounded-pill px-3 py-2"><i class="bi bi-check2-all me-1"></i>Completed</span>
                                                @endif
                                            </td>
                                            <td class="text-end pe-3">
                                                @if($booking->status == 'pending')
                                                    <form action="{{ route('student.bookings.cancel', $booking) }}" method="POST" class="d-inline" onsubmit="return confirm('Cancel this booking request?')">
                                                        @csrf @method('PATCH')
                                                        <button class="btn btn-sm btn-outline-danger rounded-pill px-3"><i class="bi bi-x-lg me-1"></i>Cancel</button>
                                                    </form>
                                                @else
                                                    <span class="text-muted small fst-italic">No actions</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5 bg-light rounded-4 border border-dashed hover-lift">
                            <div class="bg-white rounded-circle d-inline-flex mx-auto p-4 mb-3 shadow-sm">
                                <i class="bi bi-calendar-x fs-1 text-muted"></i>
                            </div>
                            <h5 class="fw-bold">No bookings found</h5>
                            <p class="text-muted mb-0">You haven't made any mentorship session bookings yet.</p>
                            <a href="{{ route('student.mentors.index') }}" class="btn btn-primary mt-3 rounded-pill px-4 hover-lift-btn">Book a Session</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Two Column Section -->
            <div class="row g-4">
                <!-- Awaiting Review -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100 rounded-4 hover-lift">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Sessions Awaiting Review</h5>
                            @if(isset($sessionsAwaitingReview) && $sessionsAwaitingReview->count() > 0)
                                <div class="list-group list-group-flush border-top-0">
                                    @foreach($sessionsAwaitingReview as $session)
                                        <div class="list-group-item px-0 py-3 border-start-0 border-end-0">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($session->mentor->name) }}&background=random" class="rounded-circle me-3 border border-2 border-white shadow-sm" width="45" height="45" alt="{{ $session->mentor->name }}">
                                                    <div>
                                                        <h6 class="mb-0 fw-bold">{{ $session->mentor->name }}</h6>
                                                        <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>{{ $session->booking_date->format('M d, Y') }}</small>
                                                    </div>
                                                </div>
                                                <a href="{{ route('student.reviews.create', $session) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 hover-lift-btn"><i class="bi bi-star-fill me-1"></i>Review</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <div class="bg-light rounded-circle d-inline-flex mx-auto p-4 mb-3">
                                        <i class="bi bi-check2-all fs-2 text-success"></i>
                                    </div>
                                    <h6 class="fw-bold text-muted">All caught up!</h6>
                                    <p class="text-muted small mb-0">No pending sessions to review.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Submitted Reviews -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100 rounded-4 hover-lift">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">My Submitted Reviews</h5>
                            @if(isset($submittedReviews) && $submittedReviews->count() > 0)
                                <div class="list-group list-group-flush border-top-0">
                                    @foreach($submittedReviews->take(3) as $review)
                                        <div class="list-group-item px-0 py-3 border-start-0 border-end-0">
                                            <div class="d-flex w-100 justify-content-between align-items-start mb-2">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($review->mentor->name) }}&background=random" class="rounded-circle me-2" width="30" height="30" alt="{{ $review->mentor->name }}">
                                                    <div>
                                                        <h6 class="mb-0 fw-bold">{{ $review->mentor->name }}</h6>
                                                        <div class="text-warning small mt-1">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('student.reviews.edit', $review) }}" class="btn btn-sm btn-light text-secondary rounded-circle" title="Edit"><i class="bi bi-pencil"></i></a>
                                                    <form action="{{ route('student.reviews.destroy', $review) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this review?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-light text-danger rounded-circle" title="Delete"><i class="bi bi-trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                            <p class="mb-1 mt-2 fw-medium text-dark">{{ $review->title }}</p>
                                            <p class="mb-1 text-muted small fst-italic">"{{ Str::limit($review->comment, 80) }}"</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <div class="bg-light rounded-circle d-inline-flex mx-auto p-4 mb-3">
                                        <i class="bi bi-chat-square-quote fs-2 text-muted"></i>
                                    </div>
                                    <h6 class="fw-bold text-muted">No reviews yet</h6>
                                    <p class="text-muted small mb-0">You haven't submitted any reviews yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    <!-- Bootstrap JS for dismissible alerts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
