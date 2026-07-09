@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-soft">
    <div>
        <h4 class="fw-bold mb-0">Users Management</h4>
        <p class="text-muted small mb-0">View, filter, and manage all platform users</p>
    </div>
</div>

<div class="card card-elevated border-0 mb-4">
    <div class="card-body p-4">
        <form method="GET" action="{{ route('admin.users.index') }}" class="row g-3 align-items-center">
            <div class="col-md-4">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="Search by name or email..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="role" class="form-select shadow-sm">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="mentor" {{ request('role') == 'mentor' ? 'selected' : '' }}>Mentor</option>
                    <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Student</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select shadow-sm">
                    <option value="">All Statuses</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-2 d-grid gap-2 d-md-flex">
                <button type="submit" class="btn btn-primary px-3 shadow-sm w-100"><i class="bi bi-funnel me-1"></i>Filter</button>
                @if(request('search') || request('role') || request('status'))
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light"><i class="bi bi-x-lg"></i></a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card card-elevated border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                    <tr>
                        <th class="ps-4">User</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" class="rounded-circle me-3" width="40" height="40" alt="{{ $user->name }}">
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $user->name }}</h6>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($user->role == 'admin')
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle px-2 py-1"><i class="bi bi-shield-lock me-1"></i>Admin</span>
                            @elseif($user->role == 'mentor')
                                <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-2 py-1"><i class="bi bi-person-badge me-1"></i>Mentor</span>
                            @else
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle px-2 py-1"><i class="bi bi-mortarboard me-1"></i>Student</span>
                            @endif
                        </td>
                        <td>
                            @if($user->isActive())
                                <span class="badge bg-success border"><i class="bi bi-check-circle me-1"></i>Active</span>
                            @else
                                <span class="badge bg-secondary border"><i class="bi bi-dash-circle me-1"></i>Inactive</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.updateStatus', $user) }}" class="d-inline" onsubmit="return confirm('Change status for this user?');">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="is_active" value="{{ $user->isActive() ? 0 : 1 }}">
                                    @if($user->isActive())
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-person-x me-1"></i>Deactivate</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-outline-success"><i class="bi bi-person-check me-1"></i>Activate</button>
                                    @endif
                                </form>
                            @else
                                <span class="text-muted small fst-italic">Current User</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state m-2">
                                <div class="empty-state-icon">
                                    <i class="bi bi-search"></i>
                                </div>
                                <h5>No users found</h5>
                                <p class="text-muted mb-0">No users match your current filter criteria.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($users->hasPages())
        <div class="card-footer bg-white border-top-0 pt-3">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
