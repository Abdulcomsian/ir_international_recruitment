<?php

namespace App\Http\Requests\Quebec\Climate;

use Illuminate\Foundation\Http\FormRequest;

class SeasonalUpdateRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'duration_from' => 'required|string',
            'duration_to' => 'required|string'
        ];
    }
}
