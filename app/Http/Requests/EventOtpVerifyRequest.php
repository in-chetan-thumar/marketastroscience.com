<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventOtpVerifyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'registration_id' => [
                'required',
                'string',
                'regex:/^MAS[A-Z0-9]{8}$/',
                'exists:event_registrations,registration_id'
            ],
            'otp' => [
                'required',
                'string',
                'size:6',
                'regex:/^[0-9]{6}$/'
            ]
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'registration_id.required' => 'Registration ID is required.',
            'registration_id.regex' => 'Invalid registration ID format.',
            'registration_id.exists' => 'Registration ID not found.',
            
            'otp.required' => 'OTP is required.',
            'otp.size' => 'OTP must be exactly 6 digits.',
            'otp.regex' => 'OTP must contain only numbers.'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'otp' => preg_replace('/\D/', '', $this->otp ?? ''),
            'registration_id' => trim($this->registration_id ?? '')
        ]);
    }
}