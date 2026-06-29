<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bootstrap-wrapper">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="d-flex justify-content-between mb-4">
                    <h3>My Bookings</h3>
                    <a href="{{ route('student.mentors.index') }}" class="btn btn-primary">Find a Mentor</a>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <h6>Upcoming Sessions</h6>
                                <h2>{{ $upcomingBookings->count() }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card text-dark bg-warning">
                            <div class="card-body">
                                <h6>Pending Bookings</h6>
                                <h2>{{ $pendingBookings->count() }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <h6>Completed Sessions</h6>
                                <h2>{{ $completedBookings->count() }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card text-white bg-secondary">
                            <div class="card-body">
                                <h6>Cancelled Bookings</h6>
                                <h2>{{ $cancelledBookings->count() }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="mt-4">Recent Bookings</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mentor</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings->take(5) as $booking)
                                <tr>
                                    <td>{{ $booking->mentor->name }}</td>
                                    <td>
                                        {{ $booking->booking_date->format('M d, Y') }} 
                                        ({{ \Carbon\Carbon::parse($booking->availability->start_time)->format('h:i A') }} - 
                                         {{ \Carbon\Carbon::parse($booking->availability->end_time)->format('h:i A') }})
                                    </td>
                                    <td>
                                        @if($booking->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($booking->status == 'accepted')
                                            <span class="badge bg-success">Accepted</span>
                                        @elseif($booking->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @elseif($booking->status == 'cancelled')
                                            <span class="badge bg-secondary">Cancelled</span>
                                        @else
                                            <span class="badge bg-primary">Completed</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->status == 'pending')
                                            <form action="{{ route('student.bookings.cancel', $booking) }}" method="POST" class="d-inline" onsubmit="return confirm('Cancel this booking?')">
                                                @csrf
                                                @method('PATCH')
                                                <button class="btn btn-sm btn-outline-danger">Cancel Request</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No bookings found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <h4 class="mt-5">Sessions Awaiting Review</h4>
                @if(isset($sessionsAwaitingReview) && $sessionsAwaitingReview->count() > 0)
                    <div class="list-group mb-4">
                        @foreach($sessionsAwaitingReview as $session)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Session with {{ $session->mentor->name }}</h6>
                                    <small class="text-muted">{{ $session->booking_date->format('M d, Y') }}</small>
                                </div>
                                <a href="{{ route('student.reviews.create', $session) }}" class="btn btn-sm btn-outline-primary">Leave Review</a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-light border">You have no pending sessions to review.</div>
                @endif

                <h4 class="mt-5">My Submitted Reviews</h4>
                @if(isset($submittedReviews) && $submittedReviews->count() > 0)
                    <div class="list-group">
                        @foreach($submittedReviews as $review)
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Mentor: {{ $review->mentor->name }} <span class="text-warning">{{ str_repeat('⭐', $review->rating) }}</span></h6>
                                    <div>
                                        <a href="{{ route('student.reviews.edit', $review) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                        <form action="{{ route('student.reviews.destroy', $review) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this review?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <p class="mb-1 mt-2 fw-bold">{{ $review->title }}</p>
                                <p class="mb-1 text-muted">{{ $review->comment }}</p>
                                <small>Submitted {{ $review->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-light border">You haven't submitted any reviews yet.</div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
