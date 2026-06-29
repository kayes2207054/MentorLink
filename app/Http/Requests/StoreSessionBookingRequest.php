<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSessionBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'availability_id' => ['required', 'exists:mentor_availabilities,id'],
            'booking_date' => ['required', 'date', 'after:today'],
            'note' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
