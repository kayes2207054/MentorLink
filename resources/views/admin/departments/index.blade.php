@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-soft">
    <div>
        <h4 class="fw-bold mb-0">Departments</h4>
        <p class="text-muted small mb-0">Manage academic departments available to mentors</p>
    </div>
    <a href="{{ route('admin.departments.create') }}" class="btn btn-primary hover-lift-btn" id="btn-add-department">
        <i class="bi bi-plus-lg me-1"></i>Add Department
    </a>
</div>

<div class="card card-elevated border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($departments as $department)
                    <tr>
                        <td class="ps-4 text-muted">#{{ $department->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 text-primary rounded d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="bi bi-building fs-5"></i>
                                </div>
                                <span class="fw-bold">{{ $department->name }}</span>
                            </div>
                        </td>
                        <td><small class="text-muted"><i class="bi bi-calendar3 me-1"></i>{{ $department->created_at->format('M d, Y') }}</small></td>
                        <td class="text-end pe-4">
                            <div class="btn-group">
                                <a href="{{ route('admin.departments.edit', $department) }}" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="{{ route('admin.departments.destroy', $department) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this department?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state m-2">
                                <div class="empty-state-icon">
                                    <i class="bi bi-building-x"></i>
                                </div>
                                <h5>No departments found</h5>
                                <p class="text-muted mb-0">Add departments that mentors can associate with their profiles.</p>
                                <a href="{{ route('admin.departments.create') }}" class="btn btn-primary mt-3 rounded-pill px-4"><i class="bi bi-plus-lg me-2"></i>Create First Department</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($departments->hasPages())
        <div class="card-footer bg-transparent border-top-0 pt-3">
            {{ $departments->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
