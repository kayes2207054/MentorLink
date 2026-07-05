<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $bookings = $user->bookedSessions()->with('mentor.mentorProfile')->latest()->get();
        $upcomingBookings = $bookings->where('booking_date', '>=', now()->toDateString())->where('status', 'accepted');
        $pendingBookings = $bookings->where('status', 'pending');
        $completedBookings = $bookings->where('status', 'completed');
        $cancelledBookings = $bookings->where('status', 'cancelled');

        // To review
        $sessionsAwaitingReview = $user->bookedSessions()->where('status', 'completed')->doesntHave('review')->with('mentor')->get();
        $submittedReviews = $user->reviewsGiven()->with('mentor', 'sessionBooking')->latest()->get();

        // Mentorship Requests Stats
        $totalRequests = $user->sentMentorshipRequests()->count();
        $pendingRequests = $user->sentMentorshipRequests()->where('status', 'pending')->count();
        $acceptedRequests = $user->sentMentorshipRequests()->where('status', 'accepted')->count();
        $pendingReviewsCount = $sessionsAwaitingReview->count();

        return view('student.dashboard', compact(
            'bookings', 'upcomingBookings', 'pendingBookings', 'completedBookings', 'cancelledBookings',
            'sessionsAwaitingReview', 'submittedReviews',
            'totalRequests', 'pendingRequests', 'acceptedRequests', 'pendingReviewsCount'
        ));
    }
}
