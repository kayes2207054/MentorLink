<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2 class="mb-0 text-white">
                    <i class="bi bi-calendar-check me-2 opacity-75"></i>Session Bookings
                </h2>
                <p class="mb-0 mt-1 text-white opacity-75 small">
                    Manage all your student session requests
                </p>
            </div>
        </div>
    </x-slot>

    <div class="fade-in">
        <div>

                @if($bookings->isEmpty())
                    <div class="empty-state" id="empty-bookings">
                        <div class="empty-state-icon"><i class="bi bi-calendar-x"></i></div>
                        <h5>No Bookings Yet</h5>
                        <p>You have no session bookings yet. They'll appear here once students start booking sessions.</p>
                    </div>
                @else
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                                        <tr>
                                            <th class="ps-4">Student</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th class="text-end pe-4">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bookings as $booking)
                                            <tr>
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($booking->student->name) }}&background=random" class="rounded-circle me-3" width="40" height="40" alt="{{ $booking->student->name }}">
                                                        <span class="fw-medium">{{ $booking->student->name }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="fw-medium">{{ $booking->booking_date->format('M d, Y') }}</div>
                                                    <small class="text-muted">{{ $booking->availability->day_of_week }}</small>
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        {{ \Carbon\Carbon::parse($booking->availability->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($booking->availability->end_time)->format('h:i A') }}
                                                    </small>
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
                                                        <div class="d-flex justify-content-end gap-2">
                                                            <form action="{{ route('mentor.bookings.updateStatus', $booking) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="accepted">
                                                                <button class="btn btn-sm btn-outline-success rounded-pill px-3"><i class="bi bi-check-lg me-1"></i>Accept</button>
                                                            </form>
                                                            <form action="{{ route('mentor.bookings.updateStatus', $booking) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="rejected">
                                                                <button class="btn btn-sm btn-outline-danger rounded-pill px-3"><i class="bi bi-x-lg me-1"></i>Reject</button>
                                                            </form>
                                                        </div>
                                                    @elseif($booking->status == 'accepted')
                                                        <div class="d-flex justify-content-end gap-2">
                                                            <form action="{{ route('mentor.bookings.updateStatus', $booking) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="completed">
                                                                <button class="btn btn-sm btn-primary rounded-pill px-3"><i class="bi bi-check2-all me-1"></i>Mark Completed</button>
                                                            </form>
                                                            <form action="{{ route('mentor.bookings.updateStatus', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="cancelled">
                                                                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"><i class="bi bi-slash-circle me-1"></i>Cancel</button>
                                                            </form>
                                                        </div>
                                                    @else
                                                        <span class="text-muted small fst-italic">No actions</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($bookings->hasPages())
                            <div class="border-top border-soft p-4 pb-0">
                                {{ $bookings->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                @endif

        </div>
    </div>
</x-app-layout>
