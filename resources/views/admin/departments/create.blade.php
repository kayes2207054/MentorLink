@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add Department</h1>
    <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">Back to List</a>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pt-4 pb-2">
                <h6 class="fw-bold mb-0"><i class="bi bi-building-add me-2 text-primary"></i>Department Details</h6>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.departments.store') }}" novalidate>
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label fw-medium">Department Name <span class="text-danger">*</span></label>
                        <div class="input-group has-validation">
                            <span class="input-group-text bg-white"><i class="bi bi-building text-muted"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Computer Science" required autofocus>
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
