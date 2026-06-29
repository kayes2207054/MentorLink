<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use App\Models\SessionBooking;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReviewController extends Controller
{
    use AuthorizesRequests;

    public function create(SessionBooking $booking)
    {
        if ($booking->student_id !== auth()->id() || $booking->status !== 'completed') {
            abort(403, 'You can only review completed sessions that belong to you.');
        }

        if ($booking->review()->exists()) {
            return redirect()->route('student.dashboard')->with('error', 'You have already reviewed this session.');
        }

        return view('student.reviews.create', compact('booking'));
    }

    public function store(StoreReviewRequest $request, SessionBooking $booking)
    {
        if ($booking->student_id !== auth()->id() || $booking->status !== 'completed') {
            abort(403, 'You can only review completed sessions that belong to you.');
        }

        if ($booking->review()->exists()) {
            return redirect()->route('student.dashboard')->with('error', 'You have already reviewed this session.');
        }

        Review::create([
            'session_booking_id' => $booking->id,
            'student_id' => auth()->id(),
            'mentor_id' => $booking->mentor_id,
            'rating' => $request->rating,
            'title' => $request->title,
            'comment' => $request->comment,
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Review submitted successfully.');
    }

    public function edit(Review $review)
    {
        $this->authorize('update', $review);

        return view('student.reviews.edit', compact('review'));
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        $this->authorize('update', $review);

        $review->update([
            'rating' => $request->rating,
            'title' => $request->title,
            'comment' => $request->comment,
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);

        $review->delete();

        return redirect()->route('student.dashboard')->with('success', 'Review deleted successfully.');
    }
}
