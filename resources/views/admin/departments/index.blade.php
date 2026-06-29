@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Departments</h1>
    <a href="{{ route('admin.departments.create') }}" class="btn btn-primary">Add Department</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $department)
            <tr>
                <td>{{ $department->id }}</td>
                <td>{{ $department->name }}</td>
                <td>{{ $department->created_at->format('M d, Y') }}</td>
                <td>
                    <a href="{{ route('admin.departments.edit', $department) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    <form method="POST" action="{{ route('admin.departments.destroy', $department) }}" class="d-inline" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $departments->links() }}
@endsection
