<x-app-layout>
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
