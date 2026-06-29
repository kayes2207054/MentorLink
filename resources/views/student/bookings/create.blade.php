<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Session with') }} {{ $mentor->name }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bootstrap-wrapper">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-4">
                    <h3>Mentor: {{ $mentor->name }}</h3>
                    <p class="text-muted">{{ $mentor->mentorProfile->designation }}</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($availabilities->isEmpty())
                    <div class="alert alert-warning">This mentor has not set up any availability slots yet.</div>
                @else
                    <form method="POST" action="{{ route('student.bookings.store', $mentor) }}" class="w-50">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Available Time Slots</label>
                            <select name="availability_id" class="form-select" required>
                                <option value="">Select a Time Slot</option>
                                @foreach($availabilities as $slot)
                                    <option value="{{ $slot->id }}" data-day="{{ $slot->day_of_week }}" {{ old('availability_id') == $slot->id ? 'selected' : '' }}>
                                        {{ $slot->day_of_week }}s ({{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">Choose a weekly time slot offered by the mentor.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select Date</label>
                            <input type="date" name="booking_date" class="form-control" value="{{ old('booking_date') }}" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                            <div class="form-text">Ensure the date matches the day of the week for the selected time slot.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Note (Optional)</label>
                            <textarea name="note" class="form-control" rows="3">{{ old('note') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Request Booking</button>
                    </form>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
