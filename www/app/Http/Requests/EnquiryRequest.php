<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnquiryRequest extends FormRequest
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
            'master_state_id' => 'required',
            'master_tehsil_id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'number' => 'required|numeric|digits:10',
        ];
    }

    public function messages(): array
    {
        return [
            'master_state_id.required' => 'The state field is required.',
            'master_tehsil_id.required' => 'The city field is required.',
            'name.required' => 'Please enter your name.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name cannot exceed 255 characters.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email cannot exceed 255 characters.',
            'number.required' => 'Please enter your phone number.',
            'number.numeric' => 'The phone number must be numeric.',
            'number.digits' => 'The phone number must be exactly 10 digits.',
        ];
    }

}
