@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Mentor Verification</h1>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <form method="GET" action="{{ route('admin.mentors.index') }}" class="row g-3 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="Search by mentor name..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Verification Status</option>
                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="unverified" {{ request('status') == 'unverified' ? 'selected' : '' }}>Unverified</option>
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-funnel me-1"></i>Filter</button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.mentors.index') }}" class="btn btn-outline-secondary">Clear</a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Mentor Name</th>
                <th>Designation</th>
                <th>Verification Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mentors as $mentor)
            <tr>
                <td>{{ $mentor->id }}</td>
                <td>{{ $mentor->name }}</td>
                <td>{{ $mentor->mentorProfile->designation ?? 'N/A' }}</td>
                <td>
                    @if($mentor->mentorProfile && $mentor->mentorProfile->is_verified)
                        <span class="badge bg-success">Verified</span>
                        <small class="d-block text-muted">{{ $mentor->mentorProfile->verified_at->format('M d, Y') }}</small>
                    @else
                        <span class="badge bg-warning text-dark">Unverified</span>
                    @endif
                </td>
                <td>
                    @if($mentor->mentorProfile)
                        <form method="POST" action="{{ route('admin.mentors.verify', $mentor->mentorProfile) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="is_verified" value="{{ $mentor->mentorProfile->is_verified ? 0 : 1 }}">
                            <button type="submit" class="btn btn-sm {{ $mentor->mentorProfile->is_verified ? 'btn-danger' : 'btn-success' }}">
                                {{ $mentor->mentorProfile->is_verified ? 'Remove Verification' : 'Verify Mentor' }}
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-search fs-1 mb-3 d-block"></i>
                        <h5>No mentors found</h5>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
        </div>
    </div>
    @if($mentors->hasPages())
        <div class="card-footer bg-white border-top-0 pt-3">
            {{ $mentors->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
