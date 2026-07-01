<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\MentorProfile;
use App\Models\MentorshipRequest;
use App\Models\Review;
use App\Models\SessionBooking;
use App\Models\Skill;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalStudents = User::where('role', User::ROLE_STUDENT)->count();
        $totalMentors = User::where('role', User::ROLE_MENTOR)->count();
        $verifiedMentors = MentorProfile::where('is_verified', true)->count();
        $pendingRequests = MentorshipRequest::where('status', 'pending')->count();
        $totalDepartments = Department::count();
        $totalSkills = Skill::count();

        $totalSessions = SessionBooking::count();
        $pendingSessions = SessionBooking::where('status', 'pending')->count();
        $acceptedSessions = SessionBooking::where('status', 'accepted')->count();
        $completedSessions = SessionBooking::where('status', 'completed')->count();
        $cancelledSessions = SessionBooking::where('status', 'cancelled')->count();

        $totalReviews = Review::count();
        $highestRatedMentors = User::where('role', User::ROLE_MENTOR)
            ->withAvg('reviewsReceived', 'rating')
            ->withCount('reviewsReceived')
            ->has('reviewsReceived')
            ->orderByDesc('reviews_received_avg_rating')
            ->take(5)
            ->get();

        $lowestRatedMentors = User::where('role', User::ROLE_MENTOR)
            ->withAvg('reviewsReceived', 'rating')
            ->withCount('reviewsReceived')
            ->has('reviewsReceived')
            ->orderBy('reviews_received_avg_rating')
            ->take(5)
            ->get();

        $recentUsers = User::latest()->take(5)->get();
        $recentBookings = SessionBooking::with(['student', 'mentor'])->latest()->take(5)->get();
        $recentReviews = Review::with(['student', 'mentor'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalMentors',
            'verifiedMentors',
            'pendingRequests',
            'totalDepartments',
            'totalSkills',
            'totalSessions',
            'pendingSessions',
            'acceptedSessions',
            'completedSessions',
            'cancelledSessions',
            'totalReviews',
            'highestRatedMentors',
            'lowestRatedMentors',
            'recentUsers',
            'recentBookings',
            'recentReviews'
        ));
    }
}
