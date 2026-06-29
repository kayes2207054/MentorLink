<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Bookings') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bootstrap-wrapper">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="mb-4">Session Bookings</h3>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if($bookings->isEmpty())
                    <div class="alert alert-info">You have no session bookings yet.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Student</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->student->name }}</td>
                                        <td>{{ $booking->booking_date->format('M d, Y') }} ({{ $booking->availability->day_of_week }})</td>
                                        <td>{{ \Carbon\Carbon::parse($booking->availability->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($booking->availability->end_time)->format('h:i A') }}</td>
                                        <td>
                                            @if($booking->status == 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif($booking->status == 'accepted')
                                                <span class="badge bg-success">Accepted</span>
                                            @elseif($booking->status == 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @elseif($booking->status == 'cancelled')
                                                <span class="badge bg-secondary">Cancelled</span>
                                            @else
                                                <span class="badge bg-primary">Completed</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($booking->status == 'pending')
                                                <form action="{{ route('mentor.bookings.updateStatus', $booking) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button class="btn btn-sm btn-success">Accept</button>
                                                </form>
                                                <form action="{{ route('mentor.bookings.updateStatus', $booking) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button class="btn btn-sm btn-danger">Reject</button>
                                                </form>
                                            @elseif($booking->status == 'accepted')
                                                <form action="{{ route('mentor.bookings.updateStatus', $booking) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="completed">
                                                    <button class="btn btn-sm btn-primary">Mark Completed</button>
                                                </form>
                                                <form action="{{ route('mentor.bookings.updateStatus', $booking) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button class="btn btn-sm btn-secondary">Cancel</button>
                                                </form>
                                            @else
                                                <span class="text-muted">No actions</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $bookings->links() }}
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
