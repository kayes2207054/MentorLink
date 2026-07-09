<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MentorResource;
use App\Models\User;
use Illuminate\Http\Request;

class MentorApiController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', User::ROLE_MENTOR)
            ->whereHas('mentorProfile', function ($q) {
                $q->where('is_verified', true);
            })
            ->withAvg('reviewsReceived', 'rating')
            ->withCount('reviewsReceived');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('skill')) {
            $query->whereHas('mentorProfile.skills', function ($q) use ($request) {
                $q->where('skills.id', $request->skill);
            });
        }

        if ($request->filled('min_rating')) {
            $query->having('reviews_received_avg_rating', '>=', $request->min_rating);
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'highest_rated') {
                $query->orderBy('reviews_received_avg_rating', 'desc');
            } elseif ($request->sort === 'most_reviewed') {
                $query->orderBy('reviews_received_count', 'desc');
            } elseif ($request->sort === 'alphabetical') {
                $query->orderBy('name', 'asc');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $mentors = $query->with(['mentorProfile.skills'])->paginate(10)->withQueryString();

        return MentorResource::collection($mentors);
    }
}
