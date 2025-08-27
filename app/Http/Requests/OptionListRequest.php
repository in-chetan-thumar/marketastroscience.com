<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OptionListRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'list_type' => 'required',
            'option_value' => 'required|string|min:1|max:150',
            'option_title' => 'required|string|min:3|max:255',
            'sort_id' => 'required|min:1|max:20',
        ];
    }
}
