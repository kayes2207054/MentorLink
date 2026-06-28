<?php

namespace App\Http\Controllers;

use App\Http\Requests\MentorProfileRequest;
use App\Models\MentorProfile;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MentorProfileController extends Controller
{
    public function show(Request $request): View
    {
        $profile = $request->user()->mentorProfile()->with('skills')->firstOrFail();

        return view('mentor.profile.show', compact('profile'));
    }

    public function create(Request $request): View|RedirectResponse
    {
        if ($request->user()->mentorProfile) {
            return redirect()->route('mentor.profile.edit');
        }

        return view('mentor.profile.create', [
            'profile' => new MentorProfile,
            'skills' => Skill::orderBy('name')->get(),
            'selectedSkills' => [],
        ]);
    }

    public function store(MentorProfileRequest $request): RedirectResponse
    {
        $profile = $request->user()->mentorProfile()->create($request->safe()->except('skills'));
        $profile->skills()->sync($request->validated('skills'));

        return redirect()->route('mentor.profile.show')->with('status', 'mentor-profile-saved');
    }

    public function edit(Request $request): View
    {
        $profile = $request->user()->mentorProfile()->with('skills')->firstOrFail();

        return view('mentor.profile.edit', [
            'profile' => $profile,
            'skills' => Skill::orderBy('name')->get(),
            'selectedSkills' => $profile->skills->pluck('id')->all(),
        ]);
    }

    public function update(MentorProfileRequest $request): RedirectResponse
    {
        $profile = $request->user()->mentorProfile()->firstOrFail();

        $profile->update($request->safe()->except('skills'));
        $profile->skills()->sync($request->validated('skills'));

        return redirect()->route('mentor.profile.show')->with('status', 'mentor-profile-saved');
    }

    public function adminShow(MentorProfile $mentorProfile): View
    {
        $mentorProfile->load(['user', 'skills']);

        return view('mentor.profile.show', ['profile' => $mentorProfile]);
    }
}
