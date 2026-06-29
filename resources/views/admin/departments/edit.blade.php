@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Department</h1>
    <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">Back to List</a>
</div>

<div class="card w-50">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.departments.update', $department) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Department Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $department->name) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Department</button>
        </form>
    </div>
</div>
@endsection
