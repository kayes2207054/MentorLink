<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2 class="mb-0 text-white">
                    <i class="bi bi-pencil me-2 opacity-75"></i>Edit Time Slot
                </h2>
                <p class="mb-0 mt-1 text-white opacity-75 small">
                    Update an existing availability slot
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
        <div class="row justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <div class="card card-elevated">
                    <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center gap-2">
                        <span class="d-inline-flex p-1 rounded-2" style="background:#ede9fe;">
                            <i class="bi bi-clock-history text-primary" style="font-size:.85rem;"></i>
                        </span>
                        <h6 class="mb-0 fw-bold">Edit Slot Details</h6>
                    </div>
                    <div class="card-body p-4">

                        @if($errors->any())
                            <div class="alert alert-danger mb-4">
                                <i class="bi bi-exclamation-circle-fill me-2"></i>
                                <ul class="mb-0 mt-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST"
                              action="{{ route('mentor.availabilities.update', $availability) }}"
                              id="edit-availability-form"
                              novalidate>
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label class="form-label">
                                    <i class="bi bi-calendar-event me-1 text-primary"></i>
                                    Day of Week <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                                    <select name="day_of_week" class="form-select" required id="edit-day-select">
                                        @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                                            <option value="{{ $day }}"
                                                    {{ old('day_of_week', $availability->day_of_week) == $day ? 'selected' : '' }}>
                                                {{ $day }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label">
                                        <i class="bi bi-clock me-1 text-primary"></i>
                                        Start Time <span class="text-danger">*</span>
                                    </label>
                                    <input type="time" name="start_time" class="form-control"
                                           id="edit-start-time"
                                           value="{{ old('start_time', \Carbon\Carbon::parse($availability->start_time)->format('H:i')) }}"
                                           required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">
                                        <i class="bi bi-clock-fill me-1 text-primary"></i>
                                        End Time <span class="text-danger">*</span>
                                    </label>
                                    <input type="time" name="end_time" class="form-control"
                                           id="edit-end-time"
                                           value="{{ old('end_time', \Carbon\Carbon::parse($availability->end_time)->format('H:i')) }}"
                                           required>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-4 hover-lift-btn"
                                        id="btn-update-slot">
                                    <i class="bi bi-check-lg me-1"></i>Update Slot
                                </button>
                                <a href="{{ route('mentor.availabilities.index') }}"
                                   class="btn px-4"
                                   style="background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;font-weight:600;">
                                    Cancel
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
