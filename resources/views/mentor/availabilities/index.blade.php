<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2 class="mb-0 text-white">
                    <i class="bi bi-calendar-week me-2 opacity-75"></i>My Availability
                </h2>
                <p class="mb-0 mt-1 text-white opacity-75 small">
                    Manage your weekly time slots for student bookings
                </p>
            </div>
            <a href="{{ route('mentor.availabilities.create') }}"
               class="btn btn-sm hover-lift-btn"
               id="btn-add-slot"
               style="background:rgba(255,255,255,.18);color:#fff;border:1px solid rgba(255,255,255,.35);border-radius:.65rem;font-weight:600;">
                <i class="bi bi-plus-lg me-1"></i>Add Time Slot
            </a>
        </div>
    </x-slot>

    <div class="fade-in">
        @if($availabilities->isEmpty())
            <div class="empty-state" id="empty-availability">
                <div class="empty-state-icon">
                    <i class="bi bi-calendar-x"></i>
                </div>
                <h5>No Availability Set</h5>
                <p>You haven't set up any availability slots yet. Add your first time slot so students can book sessions with you.</p>
                <a href="{{ route('mentor.availabilities.create') }}"
                   class="btn btn-primary mt-3 rounded-pill px-4 hover-lift-btn"
                   id="btn-add-first-slot">
                    <i class="bi bi-plus-lg me-2"></i>Add First Slot
                </a>
            </div>
        @else
            <div class="card card-elevated">
                <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center justify-content-between">
                    <h6 class="mb-0 fw-bold d-flex align-items-center gap-2">
                        <span class="d-inline-flex p-1 rounded-2" style="background:#ede9fe;">
                            <i class="bi bi-calendar-check-fill text-primary" style="font-size:.85rem;"></i>
                        </span>
                        Weekly Slots ({{ $availabilities->count() }} total)
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="availability-table">
                            <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                                <tr>
                                    <th class="ps-4">Day</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Duration</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($availabilities as $slot)
                                    <tr>
                                        <td class="ps-4">
                                            <span class="day-badge">
                                                {{ $slot->day_of_week }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold">
                                                <i class="bi bi-clock me-1 text-muted"></i>
                                                {{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold">
                                                <i class="bi bi-clock-fill me-1 text-muted"></i>
                                                {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}
                                            </span>
                                        </td>
                                        <td>
                                            @php
                                                $start = \Carbon\Carbon::parse($slot->start_time);
                                                $end   = \Carbon\Carbon::parse($slot->end_time);
                                                $mins  = $start->diffInMinutes($end);
                                                $h = intdiv($mins, 60);
                                                $m = $mins % 60;
                                            @endphp
                                            <span class="text-muted small">
                                                {{ $h > 0 ? $h.'h ' : '' }}{{ $m > 0 ? $m.'m' : '' }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('mentor.availabilities.edit', $slot) }}"
                                                   class="btn btn-sm rounded-pill px-3 hover-lift-btn"
                                                   id="btn-edit-slot-{{ $slot->id }}"
                                                   style="background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;font-weight:600;">
                                                    <i class="bi bi-pencil me-1"></i>Edit
                                                </a>
                                                <form action="{{ route('mentor.availabilities.destroy', $slot) }}"
                                                      method="POST" class="d-inline"
                                                      id="delete-slot-{{ $slot->id }}"
                                                      onsubmit="return confirm('Delete this time slot?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-danger rounded-pill px-3 hover-lift-btn">
                                                        <i class="bi bi-trash me-1"></i>Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
