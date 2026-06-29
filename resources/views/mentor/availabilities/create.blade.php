<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Availability') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bootstrap-wrapper">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>New Time Slot</h3>
                    <a href="{{ route('mentor.availabilities.index') }}" class="btn btn-secondary">Back</a>
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

                <form method="POST" action="{{ route('mentor.availabilities.store') }}" class="w-50">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Day of Week</label>
                        <select name="day_of_week" class="form-select" required>
                            <option value="">Select Day</option>
                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                <option value="{{ $day }}" {{ old('day_of_week') == $day ? 'selected' : '' }}>{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Start Time</label>
                        <input type="time" name="start_time" class="form-control" value="{{ old('start_time') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">End Time</label>
                        <input type="time" name="end_time" class="form-control" value="{{ old('end_time') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Slot</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
