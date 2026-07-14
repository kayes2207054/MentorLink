<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SessionBooking;

class SessionBookingController extends Controller
{
    public function index()
    {
        $bookings = SessionBooking::with(['mentor', 'student', 'availability'])->latest('booking_date')->paginate(15);

        $total = SessionBooking::count();
        $pending = SessionBooking::where('status', 'pending')->count();
        $completed = SessionBooking::where('status', 'completed')->count();
        $cancelled = SessionBooking::where('status', 'cancelled')->count();

        return view('admin.bookings.index', compact('bookings', 'total', 'pending', 'completed', 'cancelled'));
    }
}
