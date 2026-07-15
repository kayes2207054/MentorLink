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
                    <thead class="table-light">
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
                                            <li><a href="javascript:void(0)" class="dropdown-item"><i class="bi bi-eye me-2 text-muted"></i>View Details</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
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
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
