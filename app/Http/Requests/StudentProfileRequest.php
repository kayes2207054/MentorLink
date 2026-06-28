<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === User::ROLE_STUDENT;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $profileId = $this->user()?->studentProfile?->id;

        return [
            'student_id' => [
                'required',
                'string',
                'max:50',
                Rule::unique('student_profiles', 'student_id')->ignore($profileId),
            ],
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'academic_year' => ['required', 'string', 'max:50'],
            'semester' => ['required', 'string', 'max:50'],
            'bio' => ['required', 'string', 'max:1000'],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
