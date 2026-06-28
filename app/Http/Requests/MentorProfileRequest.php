<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class MentorProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === User::ROLE_MENTOR;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'designation' => ['required', 'string', 'max:255'],
            'experience' => ['required', 'string', 'max:1000'],
            'bio' => ['required', 'string', 'max:1000'],
            'skills' => ['required', 'array', 'min:1'],
            'skills.*' => ['integer', 'exists:skills,id'],
        ];
    }
}
