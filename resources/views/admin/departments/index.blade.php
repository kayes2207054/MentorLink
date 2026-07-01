@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Departments</h1>
    <a href="{{ route('admin.departments.create') }}" class="btn btn-primary">Add Department</a>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
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
                            <div class="text-center py-5 text-muted">
                                <i class="bi bi-building-x fs-1 mb-3 d-block"></i>
                                <h5>No departments found</h5>
                                <a href="{{ route('admin.departments.create') }}" class="btn btn-primary mt-2">Create First Department</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($departments->hasPages())
        <div class="card-footer bg-white border-top-0 pt-3">
            {{ $departments->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
