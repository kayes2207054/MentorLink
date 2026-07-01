<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leave a Review') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bootstrap-wrapper">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 pt-4 pb-2">
                            <h4 class="fw-bold mb-1"><i class="bi bi-star-fill text-warning me-2"></i>Review for {{ $booking->mentor->name }}</h4>
                            <p class="text-muted small mb-0"><i class="bi bi-calendar3 me-1"></i>Session Date: {{ $booking->booking_date->format('M d, Y') }}</p>
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
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required placeholder="e.g. Great mentor, very helpful!">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Comment <span class="text-danger">*</span></label>
                                    <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" rows="5" required placeholder="Share details about your experience, what you learned, and how the mentor helped you...">{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-send-fill me-1"></i>Submit Review</button>
                                    <a href="{{ route('student.dashboard') }}" class="btn btn-light px-4">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
