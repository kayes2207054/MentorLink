<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMentorshipRequest;
use App\Http\Requests\UpdateMentorshipRequest;
use App\Models\MentorshipRequest;
use Illuminate\Http\Request;

class MentorshipRequestController extends Controller
{
    public function mentorIndex(Request $request)
    {
        $requests = $request->user()->receivedMentorshipRequests()->with('student.studentProfile')->latest()->paginate(15);

        return view('mentor.mentorship-requests.index', compact('requests'));
    }

    public function studentIndex(Request $request)
    {
        $requests = $request->user()->sentMentorshipRequests()->with('mentor.mentorProfile')->latest()->paginate(15);

        return view('student.mentorship-requests.index', compact('requests'));
    }

    public function store(StoreMentorshipRequest $request)
    {
        $validated = $request->validated();

        $request->user()->sentMentorshipRequests()->create([
            'mentor_id' => $validated['mentor_id'],
            'message' => $validated['message'],
            'status' => 'pending',
        ]);

        return redirect()->route('student.mentors.show', $validated['mentor_id'])
            ->with('status', 'Mentorship request sent successfully.');
    }

    public function update(UpdateMentorshipRequest $request, MentorshipRequest $mentorshipRequest)
    {
        $validated = $request->validated();

        $mentorshipRequest->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('mentor.dashboard')
            ->with('status', 'Request '.$validated['status'].' successfully.');
    }

    public function destroy(Request $request, MentorshipRequest $mentorshipRequest)
    {
        // Ensure student owns this request
        if ($request->user()->id !== $mentorshipRequest->student_id) {
            abort(403);
        }

        // Only pending requests can be cancelled
        if ($mentorshipRequest->status !== 'pending') {
            return back()->with('error', 'Only pending requests can be cancelled.');
        }

        $mentorshipRequest->update(['status' => 'cancelled']);

        return back()->with('status', 'Mentorship request cancelled.');
    }
}
