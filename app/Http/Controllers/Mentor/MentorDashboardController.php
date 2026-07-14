<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MentorDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $requests = $user->receivedMentorshipRequests()->with('student.studentProfile')->latest()->get();
        $pendingRequests = $requests->where('status', 'pending');
        $acceptedRequests = $requests->where('status', 'accepted');
        $rejectedRequests = $requests->where('status', 'rejected');

        // Bookings
        $bookings = $user->mentorSessions()->with('student')->latest()->get();
        $todayBookings = $bookings->where('booking_date', now()->toDateString());
        $upcomingBookings = $bookings->where('booking_date', '>', now()->toDateString())->where('status', 'accepted');
        $pendingBookings = $bookings->where('status', 'pending');
        $completedBookings = $bookings->where('status', 'completed');

        $reviews = $user->reviewsReceived()->with('student')->latest()->take(5)->get();

        $averageRating = $user->mentorProfile->averageRating() ?? 0;
        $totalReviews = $user->mentorProfile->totalReviews() ?? 0;

        // Mentor Insights
        $totalRequests = $requests->count();
        $availabilitySlotCount = $user->mentorProfile ? $user->mentorProfile->availabilities()->count() : 0;

        return view('mentor.dashboard', compact(
            'pendingRequests', 'acceptedRequests', 'rejectedRequests',
            'bookings', 'todayBookings', 'upcomingBookings', 'pendingBookings', 'completedBookings',
            'reviews', 'averageRating', 'totalReviews',
            'totalRequests', 'availabilitySlotCount'
        ));
    }
}
