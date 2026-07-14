<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 class="mb-1 text-white font-heading display-6 fw-bold">
                    My Bookings
                </h2>
                <p class="mb-0 text-white opacity-75 fs-5">
                    Your complete session booking history
                </p>
            </div>
        </div>
    </x-slot>

    <div class="fade-in">
        <div class="card card-elevated border-0 fade-in-stagger">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Mentor</th>
                                <th>Schedule</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($booking->mentor->name) }}&background=4f46e5&color=fff&size=45"
                                                 class="rounded-circle shadow-sm" width="40" height="40" alt="Avatar">
                                            <div>
                                                <div class="fw-bold text-dark">{{ $booking->mentor->name }}</div>
                                                <small class="text-muted">{{ $booking->mentor->mentorProfile->designation ?? 'Mentor' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-medium text-dark">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</div>
                                        <small class="text-muted">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ \Carbon\Carbon::parse($booking->availability->start_time)->format('h:i A') }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="d-inline-block text-truncate text-muted" style="max-width: 200px;" title="{{ $booking->note }}">
                                            {{ $booking->note ?: '—' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($booking->status == 'pending')
                                            <span class="badge badge-status-pending"><i class="bi bi-clock"></i>Pending</span>
                                        @elseif($booking->status == 'accepted')
                                            <span class="badge badge-status-accepted"><i class="bi bi-check-circle"></i>Accepted</span>
                                        @elseif($booking->status == 'rejected')
                                            <span class="badge badge-status-rejected"><i class="bi bi-x-circle"></i>Rejected</span>
                                        @elseif($booking->status == 'cancelled')
                                            <span class="badge badge-status-cancelled"><i class="bi bi-slash-circle"></i>Cancelled</span>
                                        @else
                                            <span class="badge badge-status-completed"><i class="bi bi-check2-all"></i>Completed</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        @if($booking->status == 'pending')
                                            <form action="{{ route('student.bookings.cancel', $booking) }}" method="POST" class="d-inline" onsubmit="return confirm('Cancel this booking request?')">
                                                @csrf @method('PATCH')
                                                <button class="btn btn-sm btn-outline-danger px-3 fw-bold rounded-pill">Cancel</button>
                                            </form>
                                        @elseif($booking->status == 'completed' && !$booking->review)
                                            <a href="{{ route('student.reviews.create', $booking) }}" class="btn btn-sm btn-outline-warning px-3 fw-bold rounded-pill">Leave Review</a>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state">
                                            <div class="empty-state-icon"><i class="bi bi-calendar-x"></i></div>
                                            <h5>No Bookings Yet</h5>
                                            <p>Start your journey by scheduling a session with an expert.</p>
                                            <a href="{{ route('student.mentors.index') }}" class="btn btn-primary mt-2">Find a Mentor</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($bookings->hasPages())
                    <div class="border-top border-soft p-4 pb-0">
                        {{ $bookings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
