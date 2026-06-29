<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Reviews') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bootstrap-wrapper">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="d-flex justify-content-between mb-4">
                    <h3>Received Reviews</h3>
                    <div>
                        <span class="badge bg-primary fs-5">Average Rating: {{ number_format(auth()->user()->mentorProfile->averageRating(), 1) }} ⭐</span>
                        <span class="badge bg-secondary fs-5">Total: {{ auth()->user()->mentorProfile->totalReviews() }}</span>
                    </div>
                </div>

                @if($reviews->isEmpty())
                    <div class="alert alert-info">You have not received any reviews yet.</div>
                @else
                    <div class="row">
                        @foreach($reviews as $review)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">{{ $review->title }}</h5>
                                        <span class="text-warning fw-bold fs-5">{{ str_repeat('⭐', $review->rating) }}</span>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{ $review->comment }}</p>
                                    </div>
                                    <div class="card-footer text-muted small d-flex justify-content-between">
                                        <span>By: {{ $review->student->name }}</span>
                                        <span>{{ $review->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    {{ $reviews->links() }}
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
