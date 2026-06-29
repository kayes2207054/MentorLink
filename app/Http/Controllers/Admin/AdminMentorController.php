<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MentorProfile;
use App\Models\User;
use Illuminate\Http\Request;

class AdminMentorController extends Controller
{
    public function index()
    {
        $mentors = User::where('role', User::ROLE_MENTOR)->with('mentorProfile')->paginate(15);

        return view('admin.mentors.index', compact('mentors'));
    }

    public function verify(Request $request, MentorProfile $mentorProfile)
    {
        $request->validate([
            'is_verified' => 'required|boolean',
        ]);

        $mentorProfile->update([
            'is_verified' => $request->is_verified,
            'verified_at' => $request->is_verified ? now() : null,
        ]);

        $status = $request->is_verified ? 'verified' : 'unverified';

        return back()->with('success', "Mentor has been marked as {$status}.");
    }
}
