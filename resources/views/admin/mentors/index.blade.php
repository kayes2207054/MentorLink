@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-soft">
    <div>
        <h4 class="fw-bold mb-0">Mentor Verification</h4>
        <p class="text-muted small mb-0">Review and manage mentor verification status</p>
    </div>
</div>

{{-- Filter --}}
<div class="card card-elevated border-0 mb-4">
    <div class="card-body p-4">
        <form method="GET" action="{{ route('admin.mentors.index') }}" id="mentor-verify-filter" class="row g-3 align-items-center">
            <div class="col-md-5">
                <div class="input-group shadow-sm border border-soft rounded">
                    <span class="input-group-text bg-transparent border-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-0 bg-transparent"
                           id="mentor-search" placeholder="Search by mentor name..."
                           value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select shadow-sm" id="filter-verify-status">
                    <option value="">All Verification Status</option>
                    <option value="verified"   {{ request('status') == 'verified'   ? 'selected' : '' }}>Verified</option>
                    <option value="unverified" {{ request('status') == 'unverified' ? 'selected' : '' }}>Unverified</option>
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4 shadow-sm w-100 hover-lift-btn" id="btn-filter-mentors">
                    <i class="bi bi-funnel me-1"></i>Filter
                </button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.mentors.index') }}"
                       class="btn btn-light px-3"
                       id="btn-clear-mentor-filter">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

{{-- Mentors Table --}}
<div class="card card-elevated border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="admin-mentors-table">
                <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                    <tr>
                        <th class="ps-4">Mentor</th>
                        <th>Designation</th>
                        <th>Verification</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mentors as $mentor)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=4f46e5&color=fff&size=80"
                                         class="rounded-circle border border-2 border-white shadow-sm"
                                         width="40" height="40" alt="{{ $mentor->name }}">
                                    <div>
                                        <div class="fw-semibold">{{ $mentor->name }}</div>
                                        <small class="text-muted">{{ $mentor->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-medium small">{{ $mentor->mentorProfile->designation ?? 'Not set' }}</span>
                            </td>
                            <td>
                                @if($mentor->mentorProfile && $mentor->mentorProfile->is_verified)
                                    <div>
                                        <span class="badge badge-status-accepted">
                                            <i class="bi bi-patch-check-fill"></i>Verified
                                        </span>
                                        <div class="small text-muted mt-1">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            {{ $mentor->mentorProfile->verified_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                @else
                                    <span class="badge badge-status-pending">
                                        <i class="bi bi-clock"></i>Unverified
                                    </span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                @if($mentor->mentorProfile)
                                    <form method="POST"
                                          action="{{ route('admin.mentors.verify', $mentor->mentorProfile) }}"
                                          class="d-inline"
                                          id="verify-form-{{ $mentor->id }}">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="is_verified"
                                               value="{{ $mentor->mentorProfile->is_verified ? 0 : 1 }}">
                                        @if($mentor->mentorProfile->is_verified)
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                    id="btn-unverify-{{ $mentor->id }}">
                                                <i class="bi bi-x-circle me-1"></i>Remove Verification
                                            </button>
                                        @else
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-success rounded-pill px-3"
                                                    id="btn-verify-{{ $mentor->id }}">
                                                <i class="bi bi-patch-check me-1"></i>Verify Mentor
                                            </button>
                                        @endif
                                    </form>
                                @else
                                    <span class="text-muted small fst-italic">No profile</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state" id="empty-mentors">
                                    <div class="empty-state-icon">
                                        <i class="bi bi-person-badge"></i>
                                    </div>
                                    <h5>No Mentors Found</h5>
                                    <p>No mentors match your current filter criteria.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($mentors->hasPages())
        <div class="border-top border-soft p-4 pb-0">
            {{ $mentors->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

@endsection
