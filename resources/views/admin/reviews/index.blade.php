@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">All Reviews</h1>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Date</th>
                        <th>Mentor</th>
                        <th>Student</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td class="ps-4">{{ $review->created_at->format('M d, Y') }}</td>
                            <td>{{ $review->mentor->name }}</td>
                            <td>{{ $review->student->name }}</td>
                            <td><span class="text-warning">{{ str_repeat('⭐', $review->rating) }}</span> ({{ $review->rating }})</td>
                            <td>
                                <strong>{{ $review->title }}</strong><br>
                                <span class="text-muted small">{{ Str::limit($review->comment, 50) }}</span>
                            </td>
                            <td class="text-end pe-4">
                                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash me-1"></i>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="text-center py-5 text-muted">
                                    <i class="bi bi-chat-left-quote fs-1 mb-3 d-block"></i>
                                    <h5>No reviews found</h5>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($reviews->hasPages())
        <div class="card-footer bg-white border-top-0 pt-3">
            {{ $reviews->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<div class="mt-4">
    {{ $reviews->links() }}
</div>
@endsection
