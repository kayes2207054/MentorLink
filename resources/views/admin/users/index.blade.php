@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Users Management</h1>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <form method="GET" action="{{ route('admin.users.index') }}" class="row g-3 align-items-center">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="Search by name or email..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="role" class="form-select">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="mentor" {{ request('role') == 'mentor' ? 'selected' : '' }}>Mentor</option>
                    <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Student</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-2 d-grid gap-2 d-md-flex">
                <button type="submit" class="btn btn-primary px-3 shadow-sm w-100">Filter</button>
                @if(request('search') || request('role') || request('status'))
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Clear</a>
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
                            <div class="text-center py-5 text-muted">
                                <i class="bi bi-search fs-1 mb-3 d-block"></i>
                                <h5>No users found</h5>
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
