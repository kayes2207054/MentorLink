<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2 class="mb-0 text-white">
                    <i class="bi bi-person-badge me-2 opacity-75"></i>
                    Mentor Dashboard
                </h2>
                <p class="mb-0 mt-1 text-white opacity-75 small">
                    Welcome back, <strong>{{ Auth::user()->name }}</strong>
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('mentor.availabilities.index') }}"
                   class="btn btn-sm hover-lift-btn"
                   id="btn-manage-availability"
                   style="background:rgba(255,255,255,.18);color:#fff;border:1px solid rgba(255,255,255,.35);border-radius:.65rem;font-weight:600;">
                    <i class="bi bi-calendar-plus me-1"></i>Availability
                </a>
                <a href="{{ route('mentor.bookings.index') }}"
                   class="btn btn-sm hover-lift-btn"
                   id="btn-all-bookings"
                   style="background:rgba(255,255,255,.25);color:#fff;border:1px solid rgba(255,255,255,.4);border-radius:.65rem;font-weight:600;">
                    <i class="bi bi-calendar-check me-1"></i>All Bookings
                </a>
            </div>
        </div>
    </x-slot>

    <div class="fade-in">

        {{-- =============================================
             MENTORSHIP ACTIVITY
             ============================================= --}}
        <div class="section-header mb-3 mt-1">
            <h5 class="section-title">Mentorship Activity</h5>
        </div>

        <div class="row g-3 mb-4 fade-in-stagger">
            <div class="col-md-4">
                <x-stat-card title="Total Requests"     :value="$totalRequests"              icon="inbox"         color="primary" />
            </div>
            <div class="col-md-4">
                <x-stat-card title="Pending Requests"   :value="$pendingRequests->count()"   icon="hourglass"     color="warning" />
            </div>
            <div class="col-md-4">
                <x-stat-card title="Availability Slots" :value="$availabilitySlotCount"       icon="clock-history" color="success" />
            </div>
        </div>

        {{-- =============================================
             SESSION BOOKINGS
             ============================================= --}}
        <div class="section-header mt-4 mb-3">
            <h5 class="section-title">Session Bookings</h5>
        </div>

        <div class="row g-3 mb-4 fade-in-stagger">
            <div class="col-6 col-md-3">
                <x-stat-card title="Today"     :value="$todayBookings->count()"     icon="calendar-day"    color="primary" />
            </div>
            <div class="col-6 col-md-3">
                <x-stat-card title="Upcoming"  :value="$upcomingBookings->count()"  icon="calendar-event"  color="success" />
            </div>
            <div class="col-6 col-md-3">
                <x-stat-card title="Pending"   :value="$pendingBookings->count()"   icon="hourglass-split" color="warning" />
            </div>
            <div class="col-6 col-md-3">
                <x-stat-card title="Completed" :value="$completedBookings->count()" icon="check-circle"    color="info" />
            </div>
        </div>

        {{-- =============================================
             TWO-COLUMN: REQUESTS + REVIEWS
             ============================================= --}}
        <div class="row g-4 mb-2">

            {{-- Mentorship Requests --}}
            <div class="col-lg-6">
                <div class="card card-elevated h-100">
                    <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center gap-2">
                        <span class="d-inline-flex p-1 rounded-2" style="background:#ede9fe;">
                            <i class="bi bi-inbox-fill text-primary" style="font-size:.85rem;"></i>
                        </span>
                        <h6 class="mb-0 fw-bold">Mentorship Requests</h6>
                    </div>
                    <div class="card-body p-4">
                        <ul class="nav nav-pills mb-3 gap-1" id="requests-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pending-tab"
                                        data-bs-toggle="pill" data-bs-target="#pending"
                                        type="button" role="tab">
                                    Pending
                                    @if($pendingRequests->count() > 0)
                                        <span class="badge ms-1 rounded-pill"
                                              style="background:#fef3c7;color:#92400e;">
                                            {{ $pendingRequests->count() }}
                                        </span>
                                    @endif
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="accepted-tab"
                                        data-bs-toggle="pill" data-bs-target="#accepted"
                                        type="button" role="tab">
                                    Accepted
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="requests-tabContent">

                            {{-- Pending Requests --}}
                            <div class="tab-pane fade show active" id="pending" role="tabpanel">
                                @if($pendingRequests->count() > 0)
                                    <div class="list-group list-group-flush" id="pending-requests-list">
                                        @foreach($pendingRequests as $request)
                                            <div class="list-group-item border-start-0 border-end-0 px-0 py-3">
                                                <div class="d-flex justify-content-between align-items-start gap-2">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($request->student->name) }}&background=random&size=80"
                                                             class="rounded-circle border border-2 border-white shadow-sm"
                                                             width="42" height="42" alt="{{ $request->student->name }}">
                                                        <div>
                                                            <h6 class="fw-bold mb-1">{{ $request->student->name }}</h6>
                                                            <p class="text-muted small mb-0 fst-italic">
                                                                "{{ Str::limit($request->message, 60) }}"
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex gap-2 flex-shrink-0">
                                                        <form method="POST" action="{{ route('mentor.mentorship-requests.update', $request) }}">
                                                            @csrf @method('PATCH')
                                                            <input type="hidden" name="status" value="accepted">
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-outline-success rounded-pill"
                                                                    id="btn-accept-request-{{ $request->id }}"
                                                                    title="Accept">
                                                                <i class="bi bi-check-lg"></i>
                                                            </button>
                                                        </form>
                                                        <form method="POST" action="{{ route('mentor.mentorship-requests.update', $request) }}">
                                                            @csrf @method('PATCH')
                                                            <input type="hidden" name="status" value="rejected">
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-outline-danger rounded-pill"
                                                                    id="btn-reject-request-{{ $request->id }}"
                                                                    title="Reject">
                                                                <i class="bi bi-x-lg"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-4" id="empty-pending">
                                        <div class="empty-state-icon mx-auto"><i class="bi bi-inbox"></i></div>
                                        <h6 class="fw-bold mt-2">No pending requests</h6>
                                        <p class="text-muted small mb-0">You're all caught up.</p>
                                    </div>
                                @endif
                            </div>

                            {{-- Accepted Requests --}}
                            <div class="tab-pane fade" id="accepted" role="tabpanel">
                                @if($acceptedRequests->count() > 0)
                                    <div class="list-group list-group-flush" id="accepted-requests-list">
                                        @foreach($acceptedRequests as $request)
                                            <div class="list-group-item border-start-0 border-end-0 px-0 py-3">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($request->student->name) }}&background=random&size=80"
                                                         class="rounded-circle border border-2 border-white shadow-sm"
                                                         width="42" height="42" alt="{{ $request->student->name }}">
                                                    <div>
                                                        <h6 class="fw-bold mb-1">{{ $request->student->name }}</h6>
                                                        <p class="text-muted small mb-0 fst-italic">
                                                            "{{ Str::limit($request->message, 60) }}"
                                                        </p>
                                                    </div>
                                                    <span class="badge badge-status-accepted rounded-pill px-2 py-1 ms-auto">
                                                        <i class="bi bi-check-circle me-1"></i>Accepted
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-4 text-muted small" id="empty-accepted">
                                        No accepted requests yet.
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Reviews --}}
            <div class="col-lg-6">
                <div class="card card-elevated h-100">
                    <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <span class="d-inline-flex p-1 rounded-2" style="background:#fef3c7;">
                                <i class="bi bi-star-fill text-warning" style="font-size:.85rem;"></i>
                            </span>
                            <h6 class="mb-0 fw-bold">Recent Reviews</h6>
                        </div>
                        <a href="{{ route('mentor.reviews.index') }}"
                           class="btn btn-sm rounded-pill hover-lift-btn"
                           style="background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0;font-weight:600;font-size:.78rem;"
                           id="btn-view-all-reviews">
                            View All
                        </a>
                    </div>
                    <div class="card-body p-4">

                        {{-- Average Rating Block --}}
                        <div class="d-flex align-items-center gap-4 p-3 mb-4 rounded-3"
                             style="background:linear-gradient(135deg,#fef9c3 0%,#fef3c7 100%);border:1px solid #fde68a;">
                            <div class="text-center flex-shrink-0">
                                <div class="fw-bold text-warning" style="font-size:2.5rem;line-height:1.1;">
                                    {{ number_format($averageRating, 1) }}
                                </div>
                                <div class="star-rating mt-1" style="font-size:.85rem;">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= round($averageRating) ? '-fill' : '' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 fw-semibold">Your Average Rating</p>
                                <p class="mb-0 text-muted small">
                                    Based on <strong>{{ $totalReviews }}</strong> review{{ $totalReviews != 1 ? 's' : '' }}
                                </p>
                            </div>
                        </div>

                        @if(isset($reviews) && $reviews->count() > 0)
                            <div class="list-group list-group-flush" id="recent-reviews-list">
                                @foreach($reviews as $review)
                                    <div class="list-group-item border-start-0 border-end-0 px-0 py-3">
                                        <div class="d-flex justify-content-between align-items-start mb-1">
                                            <h6 class="mb-0 fw-bold">{{ $review->title }}</h6>
                                            <small class="text-muted bg-light px-2 py-1 rounded-pill ms-2 flex-shrink-0">
                                                {{ $review->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                        <div class="star-rating mb-2" style="font-size:.8rem;">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                            @endfor
                                        </div>
                                        <p class="mb-2 small text-secondary fst-italic">"{{ $review->comment }}"</p>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($review->student->name) }}&background=random&size=40"
                                                 class="rounded-circle" width="22" height="22" alt="{{ $review->student->name }}">
                                            <small class="text-muted fw-semibold">{{ $review->student->name }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4" id="empty-reviews">
                                <div class="empty-state-icon mx-auto" style="background:#fef3c7;color:#f59e0b;">
                                    <i class="bi bi-star"></i>
                                </div>
                                <h6 class="fw-bold mt-2">No reviews yet</h6>
                                <p class="text-muted small mb-0">Reviews from your students will appear here.</p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>{{-- end row --}}
    </div>{{-- end fade-in --}}
</x-app-layout>
