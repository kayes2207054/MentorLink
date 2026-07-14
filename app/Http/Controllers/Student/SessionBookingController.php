<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSessionBookingRequest;
use App\Models\MentorAvailability;
use App\Models\SessionBooking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SessionBookingController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $bookings = auth()->user()->bookedSessions()->with(['mentor.mentorProfile', 'availability'])->latest('booking_date')->paginate(15);

        return view('student.bookings.index', compact('bookings'));
    }

    public function create(User $mentor)
    {
        if ($mentor->role !== User::ROLE_MENTOR || ! $mentor->mentorProfile || ! $mentor->mentorProfile->is_verified) {
            abort(404, 'Mentor not found or not verified.');
        }

        if ($mentor->id === auth()->id()) {
            abort(403, 'You cannot book a session with yourself.');
        }

        $availabilities = $mentor->mentorProfile->availabilities;

        return view('student.bookings.create', compact('mentor', 'availabilities'));
    }

    public function store(StoreSessionBookingRequest $request, User $mentor)
    {
        if ($mentor->role !== User::ROLE_MENTOR || ! $mentor->mentorProfile || ! $mentor->mentorProfile->is_verified) {
            abort(404, 'Mentor not found or not verified.');
        }

        if ($mentor->id === auth()->id()) {
            abort(403, 'You cannot book a session with yourself.');
        }

        $availability = MentorAvailability::findOrFail($request->availability_id);

        if ($availability->mentor_profile_id !== $mentor->mentorProfile->id) {
            abort(403, 'Invalid availability slot for this mentor.');
        }

        $bookingDate = Carbon::parse($request->booking_date);

        if ($bookingDate->format('l') !== $availability->day_of_week) {
            return back()->withErrors(['booking_date' => 'The selected date does not match the day of the week for this availability slot.'])->withInput();
        }

        // Check for double booking
        $existingBooking = SessionBooking::where('availability_id', $availability->id)
            ->whereDate('booking_date', $request->booking_date)
            ->whereIn('status', ['pending', 'accepted'])
            ->exists();

        if ($existingBooking) {
            return back()->withErrors(['availability_id' => 'This slot is already booked for the selected date.'])->withInput();
        }

        SessionBooking::create([
            'mentor_id' => $mentor->id,
            'student_id' => auth()->id(),
            'availability_id' => $availability->id,
            'booking_date' => $request->booking_date,
            'note' => $request->note,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Session booking requested successfully.');
    }

    public function cancel(SessionBooking $booking)
    {
        $this->authorize('cancel', $booking);

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking cancelled successfully.');
    }
}
