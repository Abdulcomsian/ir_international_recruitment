<?php

namespace App\Http\Requests\Quebec\LegalAspect;

use Illuminate\Foundation\Http\FormRequest;

class LegalAidStoreRequest extends FormRequest
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
            'img' => 'required|image|max:10240|mimes:png,jpg,jpeg,gif',
            'title' => 'required|string',
            'email' => 'required|string|email',
            'phone_no' => 'required|string',
            'address' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'city_id.required' => 'The City field is required',
            'city_id.exist' => 'Selected city not found'
        ];
    }
}
