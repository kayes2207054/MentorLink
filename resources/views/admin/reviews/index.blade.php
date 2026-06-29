@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">All Reviews</h1>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Mentor</th>
                <th>Student</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reviews as $review)
                <tr>
                    <td>{{ $review->created_at->format('M d, Y') }}</td>
                    <td>{{ $review->mentor->name }}</td>
                    <td>{{ $review->student->name }}</td>
                    <td><span class="text-warning">{{ str_repeat('⭐', $review->rating) }}</span> ({{ $review->rating }})</td>
                    <td>
                        <strong>{{ $review->title }}</strong><br>
                        <span class="text-muted small">{{ Str::limit($review->comment, 50) }}</span>
                    </td>
                    <td>
                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No reviews found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $reviews->links() }}
</div>
@endsection
