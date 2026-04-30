<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'resource_id' => 'required|exists:resources,id',
            'identifier' => 'required|string|max:255',
            'cat_name' => 'required|string|max:255',
            'check_interval' => [
                'required',
                'integer',
                'min:14400',
                'max:28800',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'check_interval.min' => 'Интервал проверки должен быть не менее 4 часов.',
            'check_interval.max' => 'Интервал проверки должен быть не более 8 часов.',
            'resource_id.exists' => 'Указаный ресурс не существует.',
        ];
    }
}
