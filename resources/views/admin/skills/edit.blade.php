@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-soft">
    <div>
        <h4 class="fw-bold mb-0">Edit Skill</h4>
        <p class="text-muted small mb-0">Update an existing skill</p>
    </div>
    <a href="{{ route('admin.skills.index') }}" class="btn btn-light shadow-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to List
    </a>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-shell">
            <h6 class="fw-bold mb-4"><i class="bi bi-pencil-square me-2 text-primary"></i>Skill Details</h6>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.skills.update', $skill) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="form-label fw-medium">Skill Name</label>
                    <input type="text" class="form-control shadow-sm" id="name" name="name" value="{{ old('name', $skill->name) }}" required>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i>Update Skill</button>
                    <a href="{{ route('admin.skills.index') }}" class="btn btn-light px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
