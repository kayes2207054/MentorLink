<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MentorProfile;
use App\Models\User;
use Illuminate\Http\Request;

class AdminMentorController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', User::ROLE_MENTOR)->with('mentorProfile');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('status')) {
            $isVerified = $request->status === 'verified';
            $query->whereHas('mentorProfile', function ($q) use ($isVerified) {
                $q->where('is_verified', $isVerified);
            });
        }

        $mentors = $query->paginate(15)->withQueryString();

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
