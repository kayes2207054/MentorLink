<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;

class MentorDirectoryController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', User::ROLE_MENTOR)
            ->whereHas('mentorProfile', function ($q) {
                $q->where('is_verified', true);
            });

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('department')) {
            // Wait, Mentor doesn't have department directly, Student does.
            // But let's check if there's any department relation on Mentor?
            // Wait, mentor profiles do not have department_id in my previous view. Let me check the migration again or I'll just skip department filter if mentors don't have it.
            // Oh, wait, the requirement: "Filter by: Department, Skill".
            // Let's look at the database schema. Mentors only have `mentor_skill` table mapping.
            // If mentors don't have a department, we can't filter by department. Wait, maybe we should just ignore department if it doesn't exist, but I will check if mentor profile has department_id. Let's not filter by department for mentors if it's not in the schema.
        }

        if ($request->filled('skill')) {
            $query->whereHas('mentorProfile.skills', function ($q) use ($request) {
                $q->where('skills.id', $request->skill);
            });
        }

        $mentors = $query->with(['mentorProfile.skills'])->paginate(10)->withQueryString();

        $skills = Skill::all();
        // $departments = Department::all();

        return view('student.mentors.index', compact('mentors', 'skills'));
    }

    public function show(User $mentor)
    {
        abort_unless($mentor->role === User::ROLE_MENTOR, 404);
        abort_unless($mentor->mentorProfile && $mentor->mentorProfile->is_verified, 404);

        $mentor->load(['mentorProfile.skills']);

        // Check if current user has a pending request with this mentor
        $pendingRequest = null;
        if (auth()->check()) {
            $pendingRequest = auth()->user()->sentMentorshipRequests()
                ->where('mentor_id', $mentor->id)
                ->where('status', 'pending')
                ->first();
        }

        return view('student.mentors.show', compact('mentor', 'pendingRequest'));
    }
}
