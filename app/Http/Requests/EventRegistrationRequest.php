<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventRegistrationRequest extends FormRequest
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
            'first_name' => [
                'required',
                'string',
                'min:2',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'last_name' => [
                'required',
                'string',
                'min:2',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                'unique:event_registrations,email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            ],
            'mobile_number' => [
                'required',
                'regex:/^[6-9][0-9]{9}$/',
                'digits:10'
            ],
            'whatsapp_number' => [
                'required',
                'regex:/^[6-9][0-9]{9}$/',
                'digits:10'
            ],
            'trading_experience' => [
                'nullable',
                'string',
                Rule::in(['beginner', 'intermediate', 'advanced', 'professional'])
            ],
            'birth_date' => [
                'nullable',
                'date',
                'before_or_equal:' . now()->subYears(10)->format('Y-m-d'),
                'after_or_equal:' . now()->subYears(100)->format('Y-m-d')
            ],
            'agree_terms' => [
                'required',
                'accepted'
            ]
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'first_name.min' => 'First name must be at least 2 characters.',
            'first_name.max' => 'First name cannot exceed 50 characters.',
            'first_name.regex' => 'First name can only contain letters and spaces.',
            
            'last_name.required' => 'Last name is required.',
            'last_name.min' => 'Last name must be at least 2 characters.',
            'last_name.max' => 'Last name cannot exceed 50 characters.',
            'last_name.regex' => 'Last name can only contain letters and spaces.',
            
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email address cannot exceed 255 characters.',
            'email.unique' => 'This email address is already registered for the event.',
            'email.regex' => 'Please enter a valid email address format.',
            
            'mobile_number.required' => 'Mobile number is required.',
            'mobile_number.regex' => 'Please enter a valid 10-digit Indian mobile number starting with 6-9.',
            'mobile_number.digits' => 'Mobile number must be exactly 10 digits.',
            
            'whatsapp_number.required' => 'WhatsApp number is required.',
            'whatsapp_number.regex' => 'Please enter a valid 10-digit Indian WhatsApp number starting with 6-9.',
            'whatsapp_number.digits' => 'WhatsApp number must be exactly 10 digits.',
            
            'trading_experience.in' => 'Please select a valid trading experience level.',
            
            'birth_date.date' => 'Please enter a valid birth date.',
            'birth_date.before_or_equal' => 'You must be at least 10 years old to register.',
            'birth_date.after_or_equal' => 'Please enter a valid birth date within the last 100 years.',
            
            'agree_terms.required' => 'You must agree to the terms and conditions.',
            'agree_terms.accepted' => 'You must accept the terms and conditions to proceed.'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'first_name' => 'first name',
            'last_name' => 'last name',
            'mobile_number' => 'mobile number',
            'whatsapp_number' => 'WhatsApp number',
            'trading_experience' => 'trading experience',
            'birth_date' => 'birth date',
            'agree_terms' => 'terms agreement'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'first_name' => trim($this->first_name),
            'last_name' => trim($this->last_name),
            'email' => trim(strtolower($this->email)),
            'mobile_number' => preg_replace('/\D/', '', $this->mobile_number),
            'whatsapp_number' => preg_replace('/\D/', '', $this->whatsapp_number),
        ]);
    }
}