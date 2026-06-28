<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentProfileRequest;
use App\Models\Department;
use App\Models\StudentProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StudentProfileController extends Controller
{
    public function show(Request $request): View
    {
        $profile = $request->user()->studentProfile()->with('department')->firstOrFail();

        return view('student.profile.show', compact('profile'));
    }

    public function create(Request $request): View|RedirectResponse
    {
        if ($request->user()->studentProfile) {
            return redirect()->route('student.profile.edit');
        }

        return view('student.profile.create', [
            'departments' => Department::orderBy('name')->get(),
            'profile' => new StudentProfile,
        ]);
    }

    public function store(StudentProfileRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('student-profiles', 'public');
        }

        $request->user()->studentProfile()->create($data);

        return redirect()->route('student.profile.show')->with('status', 'student-profile-saved');
    }

    public function edit(Request $request): View
    {
        return view('student.profile.edit', [
            'departments' => Department::orderBy('name')->get(),
            'profile' => $request->user()->studentProfile()->firstOrFail(),
        ]);
    }

    public function update(StudentProfileRequest $request): RedirectResponse
    {
        $profile = $request->user()->studentProfile()->firstOrFail();
        $data = $request->validated();

        if ($request->hasFile('profile_photo')) {
            if ($profile->profile_photo) {
                Storage::disk('public')->delete($profile->profile_photo);
            }

            $data['profile_photo'] = $request->file('profile_photo')->store('student-profiles', 'public');
        } else {
            unset($data['profile_photo']);
        }

        $profile->update($data);

        return redirect()->route('student.profile.show')->with('status', 'student-profile-saved');
    }

    public function adminShow(StudentProfile $studentProfile): View
    {
        $studentProfile->load(['user', 'department']);

        return view('student.profile.show', ['profile' => $studentProfile]);
    }
}
