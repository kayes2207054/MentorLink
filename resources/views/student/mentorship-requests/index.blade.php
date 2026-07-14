<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 class="mb-1 text-white font-heading display-6 fw-bold">
                    My Requests
                </h2>
                <p class="mb-0 text-white opacity-75 fs-5">
                    Track your mentorship requests and statuses
                </p>
            </div>
            <a href="{{ route('student.mentors.index') }}"
               class="btn btn-light btn-lg fw-bold text-primary shadow-sm hover-lift-btn px-4 rounded-pill">
                <i class="bi bi-search me-2"></i>Find a Mentor
            </a>
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
                                <th>Date Sent</th>
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
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($request->mentor->name) }}&background=4f46e5&color=fff&size=45"
                                                 class="rounded-circle shadow-sm" width="40" height="40" alt="Avatar">
                                            <div>
                                                <div class="fw-bold text-dark">{{ $request->mentor->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-medium text-dark">{{ $request->created_at->format('M d, Y') }}</div>
                                        <small class="text-muted">{{ $request->created_at->format('h:i A') }}</small>
                                    </td>
                                    <td>
                                        <span class="d-inline-block text-truncate text-muted" style="max-width: 300px;" title="{{ $request->message }}">
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
                                            <form method="POST" action="{{ route('student.mentorship-requests.destroy', $request) }}" onsubmit="return confirm('Are you sure you want to cancel this request?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm px-3 fw-bold rounded-pill">Cancel</button>
                                            </form>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state">
                                            <div class="empty-state-icon"><i class="bi bi-inbox"></i></div>
                                            <h5>No requests found</h5>
                                            <p>You haven't sent any mentorship requests yet.</p>
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
</x-app-layout>
