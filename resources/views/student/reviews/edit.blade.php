<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2 class="mb-0 text-white">
                    <i class="bi bi-pencil me-2 opacity-75"></i>Edit Review
                </h2>
                <p class="mb-0 mt-1 text-white opacity-75 small">
                    Review for <strong>{{ $review->mentor->name }}</strong>
                    &mdash; {{ $review->sessionBooking->booking_date->format('M d, Y') }}
                </p>
            </div>
            <a href="{{ route('student.dashboard') }}"
               class="btn btn-sm"
               style="background:rgba(255,255,255,.18);color:#fff;border:1px solid rgba(255,255,255,.35);border-radius:.65rem;font-weight:600;">
                <i class="bi bi-arrow-left me-1"></i>Back
            </a>
        </div>
    </x-slot>

    <div class="fade-in">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-xl-6">
                <div class="card card-elevated">
                    <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($review->mentor->name) }}&background=4f46e5&color=fff&size=80"
                             class="rounded-circle" width="44" height="44" alt="{{ $review->mentor->name }}">
                        <div>
                            <h5 class="fw-bold mb-0">{{ $review->mentor->name }}</h5>
                            <small class="text-muted">
                                <i class="bi bi-calendar3 me-1"></i>
                                Session on {{ $review->sessionBooking->booking_date->format('M d, Y') }}
                            </small>
                        </div>
                    </div>
                    <div class="card-body p-4">

                        @if($errors->any())
                            <div class="alert alert-danger mb-4" id="review-errors">
                                <i class="bi bi-exclamation-circle-fill me-2"></i>
                                <ul class="mb-0 mt-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('student.reviews.update', $review) }}"
                              method="POST" id="edit-review-form" novalidate>
                            @csrf
                            @method('PATCH')

                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    Overall Rating <span class="text-danger">*</span>
                                </label>
                                <select name="rating" id="edit-rating"
                                        class="form-select form-select-lg" required>
                                    <option value="5" {{ old('rating', $review->rating) == 5 ? 'selected' : '' }}>&#9733;&#9733;&#9733;&#9733;&#9733; 5 &mdash; Excellent</option>
                                    <option value="4" {{ old('rating', $review->rating) == 4 ? 'selected' : '' }}>&#9733;&#9733;&#9733;&#9733;&#9734; 4 &mdash; Very Good</option>
                                    <option value="3" {{ old('rating', $review->rating) == 3 ? 'selected' : '' }}>&#9733;&#9733;&#9733;&#9734;&#9734; 3 &mdash; Good</option>
                                    <option value="2" {{ old('rating', $review->rating) == 2 ? 'selected' : '' }}>&#9733;&#9733;&#9734;&#9734;&#9734; 2 &mdash; Fair</option>
                                    <option value="1" {{ old('rating', $review->rating) == 1 ? 'selected' : '' }}>&#9733;&#9734;&#9734;&#9734;&#9734; 1 &mdash; Poor</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    Title <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-type text-muted"></i></span>
                                    <input type="text" name="title" id="edit-title"
                                           class="form-control @error('title') is-invalid @enderror"
                                           value="{{ old('title', $review->title) }}"
                                           required placeholder="e.g. Great mentor, very helpful!">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    Comment <span class="text-danger">*</span>
                                </label>
                                <textarea name="comment" id="edit-comment"
                                          class="form-control @error('comment') is-invalid @enderror"
                                          rows="5" required
                                          placeholder="Share what you learned and how the mentor helped you...">{{ old('comment', $review->comment) }}</textarea>
                                @error('comment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-4 hover-lift-btn"
                                        id="btn-update-review">
                                    <i class="bi bi-check-lg me-1"></i>Update Review
                                </button>
                                <a href="{{ route('student.dashboard') }}"
                                   class="btn px-4"
                                   style="background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;font-weight:600;">
                                    Cancel
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
