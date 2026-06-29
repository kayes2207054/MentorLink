<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreMentorshipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === User::ROLE_STUDENT;
    }

    public function rules(): array
    {
        return [
            'mentor_id' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $mentor = User::find($value);
                    if (! $mentor || $mentor->role !== User::ROLE_MENTOR || ! $mentor->mentorProfile || ! $mentor->mentorProfile->is_verified) {
                        $fail('The selected user is not a verified mentor.');
                    }

                    // Check for duplicate pending requests
                    $duplicate = $this->user()->sentMentorshipRequests()
                        ->where('mentor_id', $value)
                        ->where('status', 'pending')
                        ->exists();

                    if ($duplicate) {
                        $fail('You already have a pending request for this mentor.');
                    }
                },
            ],
            'message' => 'required|string|max:1000',
        ];
    }
}
