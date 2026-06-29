@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Users Management</h1>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.users.index') }}" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="role" class="form-select">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="mentor" {{ request('role') == 'mentor' ? 'selected' : '' }}>Mentor</option>
                    <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Student</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Clear</a>
            </div>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><span class="badge bg-secondary">{{ ucfirst($user->role) }}</span></td>
                <td>
                    @if($user->isActive())
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>
                <td>
                    @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.updateStatus', $user) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="is_active" value="{{ $user->isActive() ? 0 : 1 }}">
                            <button type="submit" class="btn btn-sm {{ $user->isActive() ? 'btn-danger' : 'btn-success' }}">
                                {{ $user->isActive() ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $users->links() }}
@endsection
