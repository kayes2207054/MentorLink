<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::where('mentor_id', auth()->id())
            ->with(['student', 'sessionBooking'])
            ->latest()
            ->paginate(10);

        return view('mentor.reviews.index', compact('reviews'));
    }
}
