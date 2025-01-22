<?php

namespace App\Http\Requests\LegalQuizCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'featured_image' => 'sometimes|image|max:10240|mimes:png,jpg,jpeg,gif',
            'title'=> 'required|string',
            'description' => 'required|string',
        ];
    }
}
