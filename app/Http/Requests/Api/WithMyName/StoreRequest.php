<?php

namespace App\Http\Requests\Api\WithMyName;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
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
            'name' => 'required|string',
            'country_code' => 'required|integer',
            'phone_no' => 'required|integer',
            'img' => 'nullable|image|max:10240|mimes:png,jpg,jpeg,gif',
            'voice_msg' => 'nullable|file|mimes:mp3,wav,ogg|max:5120',
            'address' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'country_code.numeric' => 'Country code must be a number',
            'phone_no.integer' => 'Phone number must be a number',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }

}
