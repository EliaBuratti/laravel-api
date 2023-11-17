<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
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
            'title' => ['required', 'min:3', Rule::unique('projects')->ignore($this->project),  'max:100'],
            'description' => 'required|min:3|max:5000',
            'cover_image' => 'required|image|max:600',
            'skills' => 'required|min:3|max:5000',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id',
            'project_link' => 'required|url|max:255',
            'github_link' => 'required|url|max:255',
        ];
    }
}
