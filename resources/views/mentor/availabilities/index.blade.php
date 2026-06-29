<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Availability') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bootstrap-wrapper">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Weekly Availability</h3>
                    <a href="{{ route('mentor.availabilities.create') }}" class="btn btn-primary">Add Slot</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($availabilities->isEmpty())
                    <div class="alert alert-info">You have not set any availability yet.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Day of Week</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($availabilities as $slot)
                                    <tr>
                                        <td>{{ $slot->day_of_week }}</td>
                                        <td>{{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}</td>
                                        <td>
                                            <a href="{{ route('mentor.availabilities.edit', $slot) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                            <form action="{{ route('mentor.availabilities.destroy', $slot) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
