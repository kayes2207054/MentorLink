@extends('layouts.admin')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-1 fw-bold font-heading">Platform Bookings</h2>
            <p class="text-muted mb-0">Overview of all mentor-student session bookings.</p>
        </div>
    </div>

    {{-- Analytics Cards --}}
    <div class="row g-4 mb-4 fade-in-stagger">
        <div class="col-sm-6 col-xl-3">
            <x-stat-card title="Total Bookings" :value="$total" icon="journal-check" color="primary" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card title="Pending" :value="$pending" icon="hourglass-split" color="warning" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card title="Completed" :value="$completed" icon="check-circle-fill" color="success" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card title="Cancelled" :value="$cancelled" icon="x-circle-fill" color="danger" />
        </div>
    </div>

    <div class="card card-elevated border-0 fade-in-stagger">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                        <tr>
                            <th class="ps-4">Date & Time</th>
                            <th>Mentor</th>
                            <th>Student</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="fw-medium text-dark">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</div>
                                    @if($booking->availability)
                                        <small class="text-muted"><i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($booking->availability->start_time)->format('h:i A') }}</small>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="fw-bold text-dark">{{ $booking->mentor->name }}</div>
                                    </div>
                                    <small class="text-muted">{{ $booking->mentor->email }}</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="fw-bold text-dark">{{ $booking->student->name }}</div>
                                    </div>
                                    <small class="text-muted">{{ $booking->student->email }}</small>
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
                                    <div class="dropdown position-static">
                                        <button class="btn-action-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-saas shadow-sm">
                                            <li><a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#bookingDetailsModal{{ $booking->id }}"><i class="bi bi-eye me-2 text-muted"></i>View Details</a></li>
                                        </ul>
                                    </div>

                                </td>
                            </tr>
                            
                            {{-- Booking Details Modal --}}
                            <div class="modal fade" id="bookingDetailsModal{{ $booking->id }}" tabindex="-1" aria-labelledby="bookingDetailsModalLabel{{ $booking->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header border-bottom-0 pb-0">
                                            <h5 class="modal-title fw-bold" id="bookingDetailsModalLabel{{ $booking->id }}">Booking Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <h6 class="text-muted text-uppercase small fw-bold mb-1">Session Schedule</h6>
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="bi bi-calendar-event text-primary"></i>
                                                    <span class="fw-medium">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</span>
                                                    @if($booking->availability)
                                                        <span class="text-muted mx-1">|</span>
                                                        <i class="bi bi-clock text-primary"></i>
                                                        <span class="fw-medium">{{ \Carbon\Carbon::parse($booking->availability->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($booking->availability->end_time)->format('h:i A') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <h6 class="text-muted text-uppercase small fw-bold mb-1">Mentor</h6>
                                                    <div class="fw-medium">{{ $booking->mentor->name }}</div>
                                                    <div class="text-muted small">{{ $booking->mentor->email }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="text-muted text-uppercase small fw-bold mb-1">Student</h6>
                                                    <div class="fw-medium">{{ $booking->student->name }}</div>
                                                    <div class="text-muted small">{{ $booking->student->email }}</div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <h6 class="text-muted text-uppercase small fw-bold mb-1">Status</h6>
                                                <div>
                                                    @if($booking->status == 'pending')
                                                        <span class="badge badge-status-pending"><i class="bi bi-clock me-1"></i>Pending</span>
                                                    @elseif($booking->status == 'accepted')
                                                        <span class="badge badge-status-accepted"><i class="bi bi-check-circle me-1"></i>Accepted</span>
                                                    @elseif($booking->status == 'rejected')
                                                        <span class="badge badge-status-rejected"><i class="bi bi-x-circle me-1"></i>Rejected</span>
                                                    @elseif($booking->status == 'cancelled')
                                                        <span class="badge badge-status-cancelled"><i class="bi bi-slash-circle me-1"></i>Cancelled</span>
                                                    @else
                                                        <span class="badge badge-status-completed"><i class="bi bi-check2-all me-1"></i>Completed</span>
                                                    @endif
                                                </div>
                                            </div>

                                            @if($booking->note)
                                            <div>
                                                <h6 class="text-muted text-uppercase small fw-bold mb-1">Student Note</h6>
                                                <div class="p-3 bg-light rounded text-dark small">
                                                    {{ $booking->note }}
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer border-top-0 pt-0">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <div class="empty-state-icon"><i class="bi bi-calendar-x"></i></div>
                                        <h5>No bookings found</h5>
                                        <p>There are currently no session bookings on the platform.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($bookings->hasPages())
                <div class="border-top border-soft p-4 pb-0">
                    {{ $bookings->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
