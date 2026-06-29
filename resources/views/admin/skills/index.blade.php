@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Skills</h1>
    <a href="{{ route('admin.skills.create') }}" class="btn btn-primary">Add Skill</a>
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
            @foreach($skills as $skill)
            <tr>
                <td>{{ $skill->id }}</td>
                <td>{{ $skill->name }}</td>
                <td>{{ $skill->created_at->format('M d, Y') }}</td>
                <td>
                    <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}" class="d-inline" onsubmit="return confirm('Are you sure?');">
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

{{ $skills->links() }}
@endsection
