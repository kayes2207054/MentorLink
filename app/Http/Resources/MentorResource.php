<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MentorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'avatar_url' => 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&background=4f46e5&color=fff&size=150',
            'profile_url' => route('student.mentors.show', $this->id),
            'designation' => $this->mentorProfile?->designation ?? 'Professional Mentor',
            'is_verified' => (bool) $this->mentorProfile?->is_verified,
            'rating' => $this->reviews_received_avg_rating ? (float) $this->reviews_received_avg_rating : 0,
            'reviews_count' => (int) $this->reviews_received_count,
            'skills' => $this->mentorProfile?->skills ? $this->mentorProfile->skills->map(function ($skill) {
                return [
                    'id' => $skill->id,
                    'name' => $skill->name,
                ];
            })->toArray() : [],
            'skills_count' => $this->mentorProfile?->skills ? $this->mentorProfile->skills->count() : 0,
        ];
    }
}
