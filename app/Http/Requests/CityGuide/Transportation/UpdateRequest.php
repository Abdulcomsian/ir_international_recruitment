<?php

namespace App\Http\Requests\CityGuide\Transportation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'city_id' => 'required|string|exists:cities,id',
            'img' => 'sometimes|image|max:10240|mimes:png,jpg,jpeg,gif',
            'title' => 'required|string',
            'type' => 'required|string',
            'contact_no' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'from_price' => [
                'nullable',
                'numeric',
                Rule::requiredIf(fn () => request()->input('to_price') !== null),
            ],
            'to_price' => [
                'nullable',
                'numeric',
                Rule::requiredIf(fn () => request()->input('from_price') !== null),
            ],
            'website_url' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'city_id.required' => 'The City field is required',
            'city_id.exist' => 'Selected city not found',
            'from_price.required' => 'Price is required',
            'from_price.numeric' => 'Price must be a number',
            'to_price.required' => 'Price is required',
            'to_price.numeric' => 'Price must be a number',
        ];
    }

}
