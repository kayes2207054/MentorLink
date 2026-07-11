@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-soft">
    <div>
        <h4 class="fw-bold mb-0">Add Department</h4>
        <p class="text-muted small mb-0">Create a new academic department</p>
    </div>
    <a href="{{ route('admin.departments.index') }}" class="btn btn-light shadow-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to List
    </a>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-shell">
            <h6 class="fw-bold mb-4"><i class="bi bi-building-add me-2 text-primary"></i>Department Details</h6>
            
            <div>
                <form method="POST" action="{{ route('admin.departments.store') }}" novalidate>
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label fw-medium">Department Name <span class="text-danger">*</span></label>
                        <div class="input-group has-validation shadow-sm border border-soft rounded">
                            <span class="input-group-text bg-transparent border-0"><i class="bi bi-building text-muted"></i></span>
                            <input type="text" class="form-control border-0 bg-transparent text-white @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Computer Science" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text mt-2"><i class="bi bi-info-circle me-1"></i>Enter a unique name for the department.</div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i>Save Department</button>
                        <a href="{{ route('admin.departments.index') }}" class="btn btn-light px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
