<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2 class="mb-0 text-white">
                    <i class="bi bi-mortarboard me-2 opacity-75"></i>
                    Student Dashboard
                </h2>
                <p class="mb-0 mt-1 text-white opacity-75 small">
                    Welcome back, <strong>{{ Auth::user()->name }}</strong>
                </p>
            </div>
            <a href="{{ route('student.mentors.index') }}"
               class="btn btn-sm hover-lift-btn"
               id="btn-find-mentor"
               style="background:rgba(255,255,255,.18);color:#fff;border:1px solid rgba(255,255,255,.35);border-radius:.65rem;font-weight:600;">
                <i class="bi bi-search me-1"></i>Find a Mentor
            </a>
        </div>
    </x-slot>

    <div class="fade-in">

        {{-- =============================================
             MENTORSHIP REQUESTS SECTION
             ============================================= --}}
        <div class="section-header mb-3 mt-1">
            <h5 class="section-title">Mentorship Requests</h5>
        </div>

        <div class="row g-3 mb-4 fade-in-stagger">
            <div class="col-6 col-md-3">
                <x-stat-card title="Total Sent"       :value="$totalRequests"        icon="send"        color="primary" />
            </div>
            <div class="col-6 col-md-3">
                <x-stat-card title="Pending"          :value="$pendingRequests"       icon="hourglass"   color="warning" />
            </div>
            <div class="col-6 col-md-3">
                <x-stat-card title="Accepted"         :value="$acceptedRequests"      icon="check-circle" color="success" />
            </div>
            <div class="col-6 col-md-3">
                <x-stat-card title="Pending Reviews"  :value="$pendingReviewsCount"   icon="star-half"   color="info" />
            </div>
        </div>

        {{-- =============================================
             BOOKINGS SECTION
             ============================================= --}}
        <div class="section-header mt-4 mb-3">
            <h5 class="section-title">My Bookings</h5>
        </div>

        <div class="row g-3 mb-4 fade-in-stagger">
            <div class="col-6 col-md-3">
                <x-stat-card title="Upcoming"  :value="$upcomingBookings->count()"  icon="calendar-event"  color="success" />
            </div>
            <div class="col-6 col-md-3">
                <x-stat-card title="Pending"   :value="$pendingBookings->count()"   icon="hourglass-split" color="warning" />
            </div>
            <div class="col-6 col-md-3">
                <x-stat-card title="Completed" :value="$completedBookings->count()" icon="check-circle"    color="primary" />
            </div>
            <div class="col-6 col-md-3">
                <x-stat-card title="Cancelled" :value="$cancelledBookings->count()" icon="x-circle"        color="secondary" />
            </div>
        </div>

        {{-- =============================================
             RECENT BOOKINGS TABLE
             ============================================= --}}
        <div class="card card-elevated mb-4">
            <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center justify-content-between">
                <h6 class="mb-0 fw-bold d-flex align-items-center gap-2">
                    <span class="d-inline-flex p-1 rounded-2" style="background:#ede9fe;">
                        <i class="bi bi-calendar-event-fill text-primary" style="font-size:.85rem;"></i>
                    </span>
                    Recent Bookings
                </h6>
            </div>
            <div class="card-body p-0">
                @if($bookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="recent-bookings-table">
                            <thead>
                                <tr>
                                    <th class="ps-4">Mentor</th>
                                    <th>Date &amp; Time</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings->take(5) as $booking)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($booking->mentor->name) }}&background=4f46e5&color=fff&size=80"
                                                     class="rounded-circle border border-2 border-white shadow-sm"
                                                     width="40" height="40" alt="{{ $booking->mentor->name }}">
                                                <div>
                                                    <div class="fw-semibold">{{ $booking->mentor->name }}</div>
                                                    <small class="text-muted">{{ $booking->mentor->mentorProfile->designation ?? 'Mentor' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-medium">{{ $booking->booking_date->format('M d, Y') }}</div>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($booking->availability->start_time)->format('h:i A') }}
                                                &ndash;
                                                {{ \Carbon\Carbon::parse($booking->availability->end_time)->format('h:i A') }}
                                            </small>
                                        </td>
                                        <td>
                                            @if($booking->status == 'pending')
                                                <span class="badge badge-status-pending rounded-pill px-3 py-2">
                                                    <i class="bi bi-clock me-1"></i>Pending
                                                </span>
                                            @elseif($booking->status == 'accepted')
                                                <span class="badge badge-status-accepted rounded-pill px-3 py-2">
                                                    <i class="bi bi-check-circle me-1"></i>Accepted
                                                </span>
                                            @elseif($booking->status == 'rejected')
                                                <span class="badge badge-status-rejected rounded-pill px-3 py-2">
                                                    <i class="bi bi-x-circle me-1"></i>Rejected
                                                </span>
                                            @elseif($booking->status == 'cancelled')
                                                <span class="badge badge-status-cancelled rounded-pill px-3 py-2">
                                                    <i class="bi bi-slash-circle me-1"></i>Cancelled
                                                </span>
                                            @else
                                                <span class="badge badge-status-completed rounded-pill px-3 py-2">
                                                    <i class="bi bi-check2-all me-1"></i>Completed
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-end pe-4">
                                            @if($booking->status == 'pending')
                                                <form action="{{ route('student.bookings.cancel', $booking) }}" method="POST"
                                                      class="d-inline" id="cancel-booking-{{ $booking->id }}"
                                                      onsubmit="return confirm('Cancel this booking request?')">
                                                    @csrf @method('PATCH')
                                                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                        <i class="bi bi-x-lg me-1"></i>Cancel
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted small fst-italic">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state m-3" id="empty-bookings">
                        <div class="empty-state-icon"><i class="bi bi-calendar-x"></i></div>
                        <h5>No bookings yet</h5>
                        <p>You haven't made any mentorship session bookings yet.</p>
                        <a href="{{ route('student.mentors.index') }}" class="btn btn-primary mt-3 rounded-pill px-4 hover-lift-btn">
                            <i class="bi bi-search me-2"></i>Book a Session
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- =============================================
             BOTTOM TWO-COLUMN SECTION
             ============================================= --}}
        <div class="row g-4 mb-2">

            {{-- Awaiting Review --}}
            <div class="col-lg-6">
                <div class="card card-elevated h-100">
                    <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center gap-2">
                        <span class="d-inline-flex p-1 rounded-2" style="background:#fef3c7;">
                            <i class="bi bi-star-fill text-warning" style="font-size:.85rem;"></i>
                        </span>
                        <h6 class="mb-0 fw-bold">Sessions Awaiting Review</h6>
                    </div>
                    <div class="card-body p-0">
                        @if(isset($sessionsAwaitingReview) && $sessionsAwaitingReview->count() > 0)
                            <div class="list-group list-group-flush" id="awaiting-review-list">
                                @foreach($sessionsAwaitingReview as $session)
                                    <div class="list-group-item px-4 py-3 border-start-0 border-end-0">
                                        <div class="d-flex justify-content-between align-items-center gap-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($session->mentor->name) }}&background=4f46e5&color=fff&size=80"
                                                     class="rounded-circle border border-2 border-white shadow-sm"
                                                     width="44" height="44" alt="{{ $session->mentor->name }}">
                                                <div>
                                                    <h6 class="mb-0 fw-bold">{{ $session->mentor->name }}</h6>
                                                    <small class="text-muted">
                                                        <i class="bi bi-calendar3 me-1"></i>
                                                        {{ $session->booking_date->format('M d, Y') }}
                                                    </small>
                                                </div>
                                            </div>
                                            <a href="{{ route('student.reviews.create', $session) }}"
                                               class="btn btn-sm btn-primary rounded-pill px-3 flex-shrink-0 hover-lift-btn"
                                               id="btn-review-{{ $session->id }}">
                                                <i class="bi bi-star-fill me-1"></i>Review
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5 px-4" id="empty-awaiting-review">
                                <div class="empty-state-icon mx-auto" style="background:#d1fae5;color:#059669;">
                                    <i class="bi bi-check2-all"></i>
                                </div>
                                <h6 class="fw-bold mt-2">All caught up!</h6>
                                <p class="text-muted small mb-0">No pending sessions to review.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Submitted Reviews --}}
            <div class="col-lg-6">
                <div class="card card-elevated h-100">
                    <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center gap-2">
                        <span class="d-inline-flex p-1 rounded-2" style="background:#dbeafe;">
                            <i class="bi bi-chat-quote-fill text-primary" style="font-size:.85rem;"></i>
                        </span>
                        <h6 class="mb-0 fw-bold">My Submitted Reviews</h6>
                    </div>
                    <div class="card-body p-0">
                        @if(isset($submittedReviews) && $submittedReviews->count() > 0)
                            <div class="list-group list-group-flush" id="submitted-reviews-list">
                                @foreach($submittedReviews->take(3) as $review)
                                    <div class="list-group-item px-4 py-3 border-start-0 border-end-0">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($review->mentor->name) }}&background=random&size=60"
                                                     class="rounded-circle" width="32" height="32"
                                                     alt="{{ $review->mentor->name }}">
                                                <div>
                                                    <h6 class="mb-0 fw-bold small">{{ $review->mentor->name }}</h6>
                                                    <div class="star-rating mt-1" style="font-size:.75rem;">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('student.reviews.edit', $review) }}"
                                                   class="btn btn-icon btn-sm bg-light border-soft text-muted"
                                                   title="Edit review" id="btn-edit-review-{{ $review->id }}">
                                                    <i class="bi bi-pencil" style="font-size:.8rem;"></i>
                                                </a>
                                                <form action="{{ route('student.reviews.destroy', $review) }}" method="POST"
                                                      class="d-inline" onsubmit="return confirm('Delete this review?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-icon btn-sm bg-light border-soft text-danger"
                                                            title="Delete review" id="btn-delete-review-{{ $review->id }}">
                                                        <i class="bi bi-trash" style="font-size:.8rem;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <p class="mb-1 fw-semibold small text-dark">{{ $review->title }}</p>
                                        <p class="mb-0 text-muted small fst-italic">
                                            "{{ Str::limit($review->comment, 80) }}"
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5 px-4" id="empty-reviews">
                                <div class="empty-state-icon mx-auto">
                                    <i class="bi bi-chat-square-quote"></i>
                                </div>
                                <h6 class="fw-bold mt-2">No reviews yet</h6>
                                <p class="text-muted small mb-0">You haven't submitted any reviews yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>{{-- end row --}}

    </div>{{-- end fade-in --}}
</x-app-layout>
