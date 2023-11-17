<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTechnologyRequest extends FormRequest
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
            /* 'type_id' => 'nullable|exists:types,id', */
            'name' => ['required', Rule::unique('technologies')->ignore($this->type), 'max:100'],
        ];
    }

    public function messages()
    {
        return [
            'name' => 'The :attribute type already exisist.',
            'name.required' => 'This field was not empty',
            'name.max' => 'The name field accept max 100 characters',
        ];
    }
}
