<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 class="mb-1 text-white font-heading display-6 fw-bold">
                    Mentor Dashboard
                </h2>
                <p class="mb-0 text-white opacity-75 fs-5">
                    Welcome back, <strong class="text-white">{{ Auth::user()->name }}</strong>
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('mentor.availabilities.index') }}" class="btn btn-light btn-lg fw-bold text-primary shadow-sm hover-lift-btn rounded-pill px-4">
                    <i class="bi bi-calendar-plus me-2"></i>Availability
                </a>
            </div>
        </div>
    </x-slot>

    <div class="fade-in">
        {{-- Activity Stats --}}
        <div class="row g-4 mb-5 fade-in-stagger">
            <div class="col-md-4">
                <x-stat-card title="Pending Requests" :value="$pendingRequests->count()" icon="inbox-fill" color="warning" />
            </div>
            <div class="col-md-4">
                <x-stat-card title="Upcoming Sessions" :value="$upcomingBookings->count()" icon="camera-video-fill" color="primary" />
            </div>
            <div class="col-md-4">
                <x-stat-card title="Completed Sessions" :value="$completedBookings->count()" icon="check-circle-fill" color="success" />
            </div>
        </div>

        <div class="row g-4 mb-4 fade-in-stagger">
            {{-- Mentorship Requests --}}
            <div class="col-lg-7">
                <div class="card card-elevated h-100 border-0">
                    <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary rounded p-2 me-3">
                                <i class="bi bi-person-lines-fill"></i>
                            </div>
                            <h5 class="mb-0 fw-bold font-heading">Mentorship Requests</h5>
                        </div>
                        @if($pendingRequests->count() > 0)
                            <span class="badge bg-danger rounded-pill">{{ $pendingRequests->count() }} New</span>
                        @endif
                    </div>
                    <div class="card-body p-0">
                        @if($pendingRequests->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($pendingRequests as $request)
                                    <div class="list-group-item p-4 border-bottom border-soft">
                                        <div class="d-flex justify-content-between align-items-start gap-3">
                                            <div class="d-flex gap-3">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($request->student->name) }}&background=f1f5f9&color=475569&size=80"
                                                     class="rounded-circle shadow-sm" width="50" height="50" alt="Avatar">
                                                <div>
                                                    <h6 class="fw-bold text-dark mb-1">{{ $request->student->name }}</h6>
                                                    <p class="text-muted small mb-0" style="line-height: 1.5;">"{{ Str::limit($request->message, 80) }}"</p>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 flex-shrink-0">
                                                <form method="POST" action="{{ route('mentor.mentorship-requests.update', $request) }}">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button type="submit" class="btn btn-success btn-sm px-3 fw-bold rounded-pill text-white shadow-sm hover-lift-btn">Accept</button>
                                                </form>
                                                <form method="POST" action="{{ route('mentor.mentorship-requests.update', $request) }}">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="btn btn-light btn-sm px-3 fw-bold rounded-pill text-danger border">Decline</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="empty-state-icon text-primary"><i class="bi bi-inbox"></i></div>
                                <h5>Inbox Zero</h5>
                                <p>You have no pending mentorship requests right now.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Recent Reviews --}}
            <div class="col-lg-5">
                <div class="card card-elevated h-100 border-0">
                    <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 text-warning rounded p-2 me-3">
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <h5 class="mb-0 fw-bold font-heading">Your Ratings</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4 p-4 rounded-4 bg-slate-50 border border-soft">
                            <h1 class="display-4 fw-bold text-dark mb-0">{{ number_format($averageRating, 1) }}</h1>
                            <div class="text-warning fs-5 my-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= round($averageRating) ? '-fill' : '' }}"></i>
                                @endfor
                            </div>
                            <span class="text-muted fw-medium">Based on {{ $totalReviews }} reviews</span>
                        </div>

                        @if(isset($reviews) && $reviews->count() > 0)
                            <h6 class="fw-bold text-uppercase text-muted small mb-3">Latest Feedback</h6>
                            @foreach($reviews->take(2) as $review)
                                <div class="mb-3 p-3 rounded-3 bg-white border shadow-sm">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div class="fw-bold text-dark small">{{ $review->student->name }}</div>
                                        <div class="text-warning small">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-muted small mb-0 fst-italic">"{{ Str::limit($review->comment, 60) }}"</p>
                                </div>
                            @endforeach
                            <a href="{{ route('mentor.reviews.index') }}" class="btn btn-outline-primary w-100 fw-bold rounded-pill mt-2">View All Reviews</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
