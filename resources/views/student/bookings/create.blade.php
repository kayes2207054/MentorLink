<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2 class="mb-0 text-white">
                    <i class="bi bi-calendar-plus me-2 opacity-75"></i>Book a Session
                </h2>
                <p class="mb-0 mt-1 text-white opacity-75 small">
                    Schedule a mentoring session with <strong>{{ $mentor->name }}</strong>
                </p>
            </div>
            <a href="{{ route('student.mentors.show', $mentor) }}"
               class="btn btn-sm"
               style="background:rgba(255,255,255,.18);color:#fff;border:1px solid rgba(255,255,255,.35);border-radius:.65rem;font-weight:600;">
                <i class="bi bi-arrow-left me-1"></i>Back to Profile
            </a>
        </div>
    </x-slot>

    <div class="fade-in">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">

                {{-- Mentor Info Strip --}}
                <div class="card card-elevated mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=4f46e5&color=fff&size=120"
                                 class="rounded-circle border border-3 shadow"
                                 style="border-color:#ede9fe!important;"
                                 width="64" height="64" alt="{{ $mentor->name }}">
                            <div>
                                <h5 class="fw-bold mb-0">{{ $mentor->name }}</h5>
                                <p class="text-muted mb-1 small">{{ $mentor->mentorProfile->designation ?? 'Professional Mentor' }}</p>
                                @if($mentor->mentorProfile && $mentor->mentorProfile->is_verified)
                                    <span class="badge rounded-pill px-2 py-1"
                                          style="background:#d1fae5;color:#065f46;font-size:.7rem;font-weight:700;">
                                        <i class="bi bi-patch-check-fill me-1"></i>Verified Mentor
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Booking Form --}}
                <div class="card card-elevated">
                    <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center gap-2">
                        <span class="d-inline-flex p-1 rounded-2" style="background:#ede9fe;">
                            <i class="bi bi-calendar-check-fill text-primary" style="font-size:.85rem;"></i>
                        </span>
                        <h6 class="mb-0 fw-bold">Session Details</h6>
                    </div>
                    <div class="card-body p-4">

                        @if($errors->any())
                            <div class="alert alert-danger mb-4" id="booking-errors">
                                <i class="bi bi-exclamation-circle-fill me-2"></i>
                                <strong>Please fix the following:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if($availabilities->isEmpty())
                            <div class="empty-state" id="no-availability">
                                <div class="empty-state-icon" style="background:#fef3c7;color:#d97706;">
                                    <i class="bi bi-calendar-x"></i>
                                </div>
                                <h5>No Availability</h5>
                                <p>This mentor hasn't set up any availability slots yet. Check back later or explore other mentors.</p>
                                <a href="{{ route('student.mentors.index') }}" class="btn btn-primary mt-3 rounded-pill px-4 hover-lift-btn">
                                    <i class="bi bi-search me-2"></i>Browse Mentors
                                </a>
                            </div>
                        @else
                            <form method="POST" action="{{ route('student.bookings.store', $mentor) }}" id="booking-form"
                                  novalidate>
                                @csrf

                                <div class="mb-4">
                                    <label for="availability_id" class="form-label">
                                        <i class="bi bi-clock me-1 text-primary"></i>
                                        Available Time Slots <span class="text-danger">*</span>
                                    </label>
                                    <select name="availability_id" id="availability_id"
                                            class="form-select" required>
                                        <option value="">— Select a time slot —</option>
                                        @foreach($availabilities as $slot)
                                            <option value="{{ $slot->id }}"
                                                    data-day="{{ $slot->day_of_week }}"
                                                    {{ old('availability_id') == $slot->id ? 'selected' : '' }}>
                                                {{ $slot->day_of_week }}s
                                                ({{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }}
                                                &ndash;
                                                {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-text">
                                        <i class="bi bi-info-circle me-1"></i>
                                        These are the weekly recurring slots this mentor offers.
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="booking_date" class="form-label">
                                        <i class="bi bi-calendar3 me-1 text-primary"></i>
                                        Session Date <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="booking_date" id="booking_date"
                                           class="form-control"
                                           value="{{ old('booking_date') }}"
                                           required
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                    <div class="form-text" id="date-hint">
                                        <i class="bi bi-exclamation-triangle me-1 text-warning"></i>
                                        Make sure the date matches the day of week for your chosen slot.
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="note" class="form-label">
                                        <i class="bi bi-chat-text me-1 text-primary"></i>
                                        Note <span class="text-muted fw-normal">(Optional)</span>
                                    </label>
                                    <textarea name="note" id="note" class="form-control" rows="3"
                                              placeholder="Any specific topics you'd like to cover in this session...">{{ old('note') }}</textarea>
                                </div>

                                <div class="d-flex gap-2 pt-2">
                                    <button type="submit" class="btn btn-primary px-4 hover-lift-btn"
                                            id="btn-submit-booking">
                                        <i class="bi bi-calendar-check me-2"></i>Request Booking
                                    </button>
                                    <a href="{{ route('student.mentors.show', $mentor) }}"
                                       class="btn px-4"
                                       style="background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;font-weight:600;">
                                        Cancel
                                    </a>
                                </div>
                            </form>

                            <script>
                            // Smart date helper: highlight if day doesn't match slot selection
                            document.addEventListener('DOMContentLoaded', function() {
                                var slotSelect = document.getElementById('availability_id');
                                var dateInput  = document.getElementById('booking_date');
                                var dateHint   = document.getElementById('date-hint');
                                var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

                                function checkDay() {
                                    var opt = slotSelect.options[slotSelect.selectedIndex];
                                    var day = opt ? opt.getAttribute('data-day') : null;
                                    if (!day || !dateInput.value) { return; }
                                    var selectedDate = new Date(dateInput.value + 'T00:00:00');
                                    var selectedDay  = days[selectedDate.getDay()];
                                    if (selectedDay !== day) {
                                        dateHint.innerHTML = '<i class="bi bi-exclamation-triangle me-1 text-danger"></i><strong class="text-danger">Date mismatch!</strong> The selected slot is for <strong>' + day + '</strong>s, but you picked a <strong>' + selectedDay + '</strong>.';
                                    } else {
                                        dateHint.innerHTML = '<i class="bi bi-check-circle me-1 text-success"></i><span class="text-success fw-medium">Date matches the selected slot (' + day + ').</span>';
                                    }
                                }

                                slotSelect.addEventListener('change', checkDay);
                                dateInput.addEventListener('change', checkDay);
                            });
                            </script>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
