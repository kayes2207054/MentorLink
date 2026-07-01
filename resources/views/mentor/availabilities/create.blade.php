<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Availability') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bootstrap-wrapper">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-header bg-white border-0 pt-4 pb-2">
                            <h4 class="fw-bold mb-0"><i class="bi bi-clock-history text-primary me-2"></i>New Time Slot</h4>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('mentor.availabilities.store') }}" novalidate>
                                @csrf
                                
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Day of Week <span class="text-danger">*</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text bg-white"><i class="bi bi-calendar-event text-muted"></i></span>
                                        <select name="day_of_week" class="form-select @error('day_of_week') is-invalid @enderror" required>
                                            <option value="">Select Day</option>
                                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                                <option value="{{ $day }}" {{ old('day_of_week') == $day ? 'selected' : '' }}>{{ $day }}</option>
                                            @endforeach
                                        </select>
                                        @error('day_of_week')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Start Time <span class="text-danger">*</span></label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text bg-white"><i class="bi bi-clock text-muted"></i></span>
                                            <input type="time" name="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time') }}" required>
                                            @error('start_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">End Time <span class="text-danger">*</span></label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text bg-white"><i class="bi bi-clock-fill text-muted"></i></span>
                                            <input type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time') }}" required>
                                            @error('end_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Save Slot</button>
                                    <a href="{{ route('mentor.availabilities.index') }}" class="btn btn-light px-4">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
