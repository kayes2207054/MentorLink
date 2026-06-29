<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Review') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bootstrap-wrapper">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="mb-4">Edit Review for {{ $review->mentor->name }}</h3>
                <p class="text-muted">Session Date: {{ $review->sessionBooking->booking_date->format('M d, Y') }}</p>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('student.reviews.update', $review) }}" method="POST" class="w-75">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Rating</label>
                        <select name="rating" class="form-select" required>
                            <option value="5" {{ old('rating', $review->rating) == 5 ? 'selected' : '' }}>5 Stars - Excellent</option>
                            <option value="4" {{ old('rating', $review->rating) == 4 ? 'selected' : '' }}>4 Stars - Very Good</option>
                            <option value="3" {{ old('rating', $review->rating) == 3 ? 'selected' : '' }}>3 Stars - Good</option>
                            <option value="2" {{ old('rating', $review->rating) == 2 ? 'selected' : '' }}>2 Stars - Fair</option>
                            <option value="1" {{ old('rating', $review->rating) == 1 ? 'selected' : '' }}>1 Star - Poor</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $review->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Comment</label>
                        <textarea name="comment" class="form-control" rows="5" required>{{ old('comment', $review->comment) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Review</button>
                    <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
