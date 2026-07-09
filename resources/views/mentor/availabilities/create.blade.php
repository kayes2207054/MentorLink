<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2 class="mb-0 text-white">
                    <i class="bi bi-clock-history me-2 opacity-75"></i>Add Availability
                </h2>
                <p class="mb-0 mt-1 text-white opacity-75 small">
                    Create a new time slot
                </p>
            </div>
            <a href="{{ route('mentor.availabilities.index') }}"
               class="btn btn-sm"
               style="background:rgba(255,255,255,.18);color:#fff;border:1px solid rgba(255,255,255,.35);border-radius:.65rem;font-weight:600;">
                <i class="bi bi-arrow-left me-1"></i>Back to Availability
            </a>
        </div>
    </x-slot>

    <div class="fade-in">
        <div class="row justify-content-center pt-4">
            <div class="col-lg-6 col-xl-5">
                <div class="card card-elevated">
                    <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center gap-2">
                        <span class="d-inline-flex p-1 rounded-2" style="background:#ede9fe;">
                            <i class="bi bi-clock-history text-primary" style="font-size:.85rem;"></i>
                        </span>
                        <h6 class="mb-0 fw-bold">New Slot Details</h6>
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
</x-app-layout>
