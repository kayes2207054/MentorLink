@extends('layouts.admin')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-1 fw-bold font-heading">Mentorship Requests</h2>
            <p class="text-muted mb-0">Overview of all mentorship requests on the platform.</p>
        </div>
    </div>

    {{-- Analytics Cards --}}
    <div class="row g-4 mb-4 fade-in-stagger">
        <div class="col-sm-6 col-xl-3">
            <x-stat-card title="Total Requests" :value="$total" icon="inbox-fill" color="primary" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card title="Pending" :value="$pending" icon="hourglass-split" color="warning" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card title="Accepted" :value="$accepted" icon="check-circle-fill" color="success" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card title="Rejected" :value="$rejected" icon="x-circle-fill" color="danger" />
        </div>
    </div>

    <div class="card card-elevated border-0 fade-in-stagger">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Date</th>
                            <th>Student</th>
                            <th>Mentor</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $req)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="fw-medium text-dark">{{ $req->created_at->format('M d, Y') }}</div>
                                    <small class="text-muted">{{ $req->created_at->format('h:i A') }}</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="fw-bold text-dark">{{ $req->student->name }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="fw-bold text-dark">{{ $req->mentor->name }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="d-inline-block text-truncate text-muted" style="max-width: 200px;">
                                        {{ $req->message }}
                                    </span>
                                </td>
                                <td>
                                    @if($req->status == 'pending')
                                        <span class="badge badge-status-pending"><i class="bi bi-clock"></i>Pending</span>
                                    @elseif($req->status == 'accepted')
                                        <span class="badge badge-status-accepted"><i class="bi bi-check-circle"></i>Accepted</span>
                                    @elseif($req->status == 'rejected')
                                        <span class="badge badge-status-rejected"><i class="bi bi-x-circle"></i>Rejected</span>
                                    @elseif($req->status == 'cancelled')
                                        <span class="badge badge-status-cancelled"><i class="bi bi-slash-circle"></i>Cancelled</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="dropdown position-static">
                                        <button class="btn-action-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-saas shadow-sm">
                                            <li><a href="javascript:void(0)" class="dropdown-item"><i class="bi bi-eye me-2 text-muted"></i>View Request</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <div class="empty-state-icon"><i class="bi bi-inbox"></i></div>
                                        <h5>No requests found</h5>
                                        <p>There are currently no mentorship requests on the platform.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($requests->hasPages())
                <div class="border-top border-soft p-4 pb-0">
                    {{ $requests->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
