<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2 class="mb-0 text-white">
                    <i class="bi bi-star me-2 opacity-75"></i>Write a Review
                </h2>
                <p class="mb-0 mt-1 text-white opacity-75 small">
                    Session with <strong>{{ $booking->mentor->name }}</strong> &mdash; {{ $booking->booking_date->format('M d, Y') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="fade-in">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-xl-6">
                <div class="card card-elevated">
                    <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($booking->mentor->name) }}&background=4f46e5&color=fff&size=80"
                             class="rounded-circle" width="44" height="44" alt="{{ $booking->mentor->name }}">
                        <div>
                            <h5 class="fw-bold mb-0">{{ $booking->mentor->name }}</h5>
                            <small class="text-muted">
                                <i class="bi bi-calendar3 me-1"></i>
                                Session on {{ $booking->booking_date->format('M d, Y') }}
                            </small>
                        </div>
                    </div>
                        <div class="card-body p-4">
                            <form action="{{ route('student.reviews.store', $booking) }}" method="POST" novalidate>
                                @csrf
                                
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Overall Rating <span class="text-danger">*</span></label>
                                    <select name="rating" class="form-select form-select-lg @error('rating') is-invalid @enderror" required>
                                        <option value="">Select a rating...</option>
                                        <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>&#9733;&#9733;&#9733;&#9733;&#9733; 5 - Excellent</option>
                                        <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>&#9733;&#9733;&#9733;&#9733;&#9734; 4 - Very Good</option>
                                        <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>&#9733;&#9733;&#9733;&#9734;&#9734; 3 - Good</option>
                                        <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>&#9733;&#9733;&#9734;&#9734;&#9734; 2 - Fair</option>
                                        <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>&#9733;&#9734;&#9734;&#9734;&#9734; 1 - Poor</option>
                                    </select>
                                    @error('rating')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text bg-white"><i class="bi bi-type text-muted"></i></span>
                                        <input type="text" name="title" class="form-control shadow-sm @error('title') is-invalid @enderror" value="{{ old('title') }}" required placeholder="e.g. Great mentor, very helpful!">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Comment <span class="text-danger">*</span></label>
                                    <textarea name="comment" class="form-control shadow-sm @error('comment') is-invalid @enderror" rows="5" required placeholder="Share details about your experience, what you learned, and how the mentor helped you...">{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-send-fill me-1"></i>Submit Review</button>
                                    <a href="{{ route('student.dashboard') }}" class="btn btn-light px-4">Cancel</a>
                                </div>
                            </form>
                            </div>{{-- card-body --}}
                    </div>{{-- card --}}
            </div>{{-- col --}}
        </div>{{-- row --}}
    </div>{{-- fade-in --}}
</x-app-layout>
