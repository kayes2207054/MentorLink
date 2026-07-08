<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2 class="mb-0 text-white">
                    <i class="bi bi-star me-2 opacity-75"></i>My Reviews
                </h2>
                <p class="mb-0 mt-1 text-white opacity-75 small">
                    Feedback received from your students
                </p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge rounded-pill px-3 py-2 fw-bold"
                      style="background:rgba(255,255,255,.18);color:#fff;border:1px solid rgba(255,255,255,.25);font-size:.8rem;">
                    <i class="bi bi-star-fill me-1" style="color:#fbbf24;"></i>
                    {{ number_format(auth()->user()->mentorProfile->averageRating(), 1) }} avg
                </span>
                <span class="badge rounded-pill px-3 py-2 fw-bold"
                      style="background:rgba(255,255,255,.12);color:#fff;border:1px solid rgba(255,255,255,.2);font-size:.8rem;">
                    {{ auth()->user()->mentorProfile->totalReviews() }} total
                </span>
            </div>
        </div>
    </x-slot>

    <div class="fade-in">
        @if($reviews->isEmpty())
            <div class="empty-state" id="empty-reviews">
                <div class="empty-state-icon" style="background:#fef3c7;color:#f59e0b;">
                    <i class="bi bi-star"></i>
                </div>
                <h5>No Reviews Yet</h5>
                <p>You haven't received any reviews yet. Complete sessions with students to earn your first review.</p>
            </div>
        @else
            <div class="row g-4" id="reviews-grid">
                @foreach($reviews as $review)
                    <div class="col-md-6">
                        <div class="card card-elevated h-100 hover-lift" id="review-card-{{ $review->id }}">
                            <div class="card-body p-4">

                                {{-- Header: title + date --}}
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="fw-bold mb-0">{{ $review->title }}</h5>
                                    <small class="text-muted bg-light px-2 py-1 rounded-pill ms-2 flex-shrink-0"
                                           style="font-size:.72rem;">
                                        {{ $review->created_at->format('M d, Y') }}
                                    </small>
                                </div>

                                {{-- Star Rating --}}
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <div class="star-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="fw-bold text-dark">{{ $review->rating }}/5</span>
                                </div>

                                {{-- Comment --}}
                                <p class="text-secondary mb-4 fst-italic">"{{ $review->comment }}"</p>

                                {{-- Footer: student --}}
                                <div class="d-flex align-items-center gap-2 pt-3 border-top border-soft">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($review->student->name) }}&background=random&size=60"
                                         class="rounded-circle border border-2 border-white shadow-sm"
                                         width="36" height="36" alt="{{ $review->student->name }}">
                                    <div>
                                        <div class="fw-semibold small">{{ $review->student->name }}</div>
                                        <div class="text-muted" style="font-size:.72rem;">Student</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $reviews->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</x-app-layout>
