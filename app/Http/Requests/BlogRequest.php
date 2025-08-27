<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
        $routes = ['blogs.edit', 'blogs.update'];

        // Base rules
        $rules = [
            'title' => 'required|string|min:1|max:250',
            'slug' => 'required|string|min:1|max:250',
            'description' => 'required|min:100|max:1000',
            'blog_date' => 'required|date',
        ];

        // Conditional file validation
        $rules['file'] = in_array(request()->route()->getName(), $routes)
            ? 'nullable|file|mimes:jpg,png,jpeg,svg,gif,webp|max:2048'
            : 'required|file|mimes:jpg,png,jpeg,svg,gif,webp|max:2048';

        return $rules;
    }

}
