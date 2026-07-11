@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-soft">
    <div>
        <h4 class="fw-bold mb-0">All Reviews</h4>
        <p class="text-muted small mb-0">Monitor and moderate student reviews across the platform</p>
    </div>
    <span class="badge rounded-pill px-3 py-2 fw-bold"
          style="background:#fef3c7;color:#92400e;font-size:.78rem;">
        <i class="bi bi-star-fill me-1" style="color:#f59e0b;"></i>
        {{ $reviews->total() }} reviews total
    </span>
</div>

<div class="card card-elevated border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="admin-reviews-table">
                <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">
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
                            <td class="ps-4">
                                <small class="text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $review->created_at->format('M d, Y') }}
                                </small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($review->mentor->name) }}&background=random&size=60"
                                         class="rounded-circle" width="30" height="30" alt="{{ $review->mentor->name }}">
                                    <span class="fw-medium small">{{ $review->mentor->name }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($review->student->name) }}&background=random&size=60"
                                         class="rounded-circle" width="30" height="30" alt="{{ $review->student->name }}">
                                    <span class="fw-medium small">{{ $review->student->name }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="star-rating" style="font-size:.8rem;">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="fw-bold small">{{ $review->rating }}/5</span>
                                </div>
                            </td>
                            <td style="max-width:220px;">
                                <div class="fw-semibold small text-truncate" title="{{ $review->title }}">
                                    {{ $review->title }}
                                </div>
                                <small class="text-muted">{{ Str::limit($review->comment, 55) }}</small>
                            </td>
                            <td class="text-end pe-4">
                                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST"
                                      id="delete-review-{{ $review->id }}"
                                      onsubmit="return confirm('Are you sure you want to permanently delete this review?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                        <i class="bi bi-trash me-1"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state m-2" id="empty-reviews">
                                    <div class="empty-state-icon" style="background:#fef3c7;color:#f59e0b;">
                                        <i class="bi bi-chat-left-quote"></i>
                                    </div>
                                    <h5>No Reviews Yet</h5>
                                    <p>There are no student reviews on the platform yet.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($reviews->hasPages())
        <div class="card-footer bg-transparent border-top border-soft pt-3 px-4">
            {{ $reviews->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

@endsection
