<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAvailabilityRequest;
use App\Http\Requests\UpdateAvailabilityRequest;
use App\Models\MentorAvailability;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function index(Request $request)
    {
        $availabilities = $request->user()->mentorProfile->availabilities()->orderBy('day_of_week')->orderBy('start_time')->get();

        return view('mentor.availabilities.index', compact('availabilities'));
    }

    public function create()
    {
        return view('mentor.availabilities.create');
    }

    public function store(StoreAvailabilityRequest $request)
    {
        $profile = $request->user()->mentorProfile;

        // Check for overlaps
        $overlap = MentorAvailability::where('mentor_profile_id', $profile->id)
            ->where('day_of_week', $request->day_of_week)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('start_time', '<', $request->end_time)
                        ->where('end_time', '>', $request->start_time);
                });
            })
            ->exists();

        if ($overlap) {
            return back()->withErrors(['time' => 'This time slot overlaps with an existing availability.'])->withInput();
        }

        $profile->availabilities()->create($request->validated());

        return redirect()->route('mentor.availabilities.index')->with('success', 'Availability added successfully.');
    }

    public function edit(MentorAvailability $availability)
    {
        if ($availability->mentor_profile_id !== auth()->user()->mentorProfile->id) {
            abort(403);
        }

        return view('mentor.availabilities.edit', compact('availability'));
    }

    public function update(UpdateAvailabilityRequest $request, MentorAvailability $availability)
    {
        if ($availability->mentor_profile_id !== auth()->user()->mentorProfile->id) {
            abort(403);
        }

        // Check for overlaps
        $overlap = MentorAvailability::where('mentor_profile_id', $availability->mentor_profile_id)
            ->where('day_of_week', $request->day_of_week)
            ->where('id', '!=', $availability->id)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('start_time', '<', $request->end_time)
                        ->where('end_time', '>', $request->start_time);
                });
            })
            ->exists();

        if ($overlap) {
            return back()->withErrors(['time' => 'This time slot overlaps with an existing availability.'])->withInput();
        }

        $availability->update($request->validated());

        return redirect()->route('mentor.availabilities.index')->with('success', 'Availability updated successfully.');
    }

    public function destroy(MentorAvailability $availability)
    {
        if ($availability->mentor_profile_id !== auth()->user()->mentorProfile->id) {
            abort(403);
        }

        $availability->delete();

        return redirect()->route('mentor.availabilities.index')->with('success', 'Availability deleted successfully.');
    }
}
