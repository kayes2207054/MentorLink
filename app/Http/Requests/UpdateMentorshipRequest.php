<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMentorshipRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only the mentor assigned to this request can update it
        $mentorshipRequest = $this->route('mentorship_request');

        return $this->user()->role === User::ROLE_MENTOR && $this->user()->id === $mentorshipRequest->mentor_id;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(['accepted', 'rejected'])],
        ];
    }
}
