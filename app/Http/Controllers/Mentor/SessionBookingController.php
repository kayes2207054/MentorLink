<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\SessionBooking;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class SessionBookingController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $bookings = auth()->user()->mentorSessions()->with(['student', 'availability'])->latest()->paginate(15);

        return view('mentor.bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, SessionBooking $booking)
    {
        $this->authorize('manage', $booking);

        $request->validate([
            'status' => 'required|in:accepted,rejected,cancelled,completed',
        ]);

        // If accepting, ensure the slot isn't already accepted by another booking on same date
        if ($request->status === 'accepted') {
            $conflict = SessionBooking::where('availability_id', $booking->availability_id)
                ->where('booking_date', $booking->booking_date)
                ->where('id', '!=', $booking->id)
                ->where('status', 'accepted')
                ->exists();

            if ($conflict) {
                return back()->with('error', 'You have already accepted another booking for this exact time slot.');
            }
        }

        $booking->update(['status' => $request->status]);

        return back()->with('success', "Booking status updated to {$request->status}.");
    }
}
