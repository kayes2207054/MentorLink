<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 class="mb-1 text-white font-heading display-6 fw-bold">
                    Mentorship Requests
                </h2>
                <p class="mb-0 text-white opacity-75 fs-5">
                    Manage all your received mentorship requests
                </p>
            </div>
        </div>
    </x-slot>

    <div class="fade-in">
        <div class="card card-elevated border-0 fade-in-stagger">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                            <tr>
                                <th class="ps-4">Student</th>
                                <th>Date</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $request)
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($request->student->name) }}&background=f1f5f9&color=475569&size=45"
                                                 class="rounded-circle shadow-sm" width="40" height="40" alt="Avatar">
                                            <div>
                                                <div class="fw-bold text-dark">{{ $request->student->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-medium text-dark">{{ $request->created_at->format('M d, Y') }}</div>
                                        <small class="text-muted">{{ $request->created_at->format('h:i A') }}</small>
                                    </td>
                                    <td>
                                        <span class="d-inline-block text-truncate text-muted" style="max-width: 300px;">
                                            {{ $request->message }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($request->status == 'pending')
                                            <span class="badge badge-status-pending"><i class="bi bi-clock"></i>Pending</span>
                                        @elseif($request->status == 'accepted')
                                            <span class="badge badge-status-accepted"><i class="bi bi-check-circle"></i>Accepted</span>
                                        @elseif($request->status == 'rejected')
                                            <span class="badge badge-status-rejected"><i class="bi bi-x-circle"></i>Rejected</span>
                                        @elseif($request->status == 'cancelled')
                                            <span class="badge badge-status-cancelled"><i class="bi bi-slash-circle"></i>Cancelled</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        @if($request->status == 'pending')
                                            <div class="d-flex gap-2 justify-content-end flex-shrink-0">
                                                <form method="POST" action="{{ route('mentor.mentorship-requests.update', $request) }}">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button type="submit" class="btn btn-success btn-sm px-3 fw-bold rounded-pill text-white shadow-sm hover-lift-btn">Accept</button>
                                                </form>
                                                <form method="POST" action="{{ route('mentor.mentorship-requests.update', $request) }}">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="btn btn-light btn-sm px-3 fw-bold rounded-pill text-danger border">Decline</button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state">
                                            <div class="empty-state-icon text-primary"><i class="bi bi-inbox"></i></div>
                                            <h5>No requests found</h5>
                                            <p>You haven't received any mentorship requests yet.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($requests->hasPages())
                    <div class="border-top border-soft p-4 pb-0">
                        {{ $requests->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
