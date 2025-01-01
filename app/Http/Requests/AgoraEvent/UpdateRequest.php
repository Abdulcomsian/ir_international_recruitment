<?php

namespace App\Http\Requests\AgoraEvent;

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
            'img' => 'nullable|image|max:10240|mimes:png,jpg,jpeg,gif',
            'title' => 'required|string',
            'price' => 'required|numeric',
            'event_datetime' => 'required|date_format:Y-m-d\TH:i',
            'hosted_by' => 'required|string',
            'members' => 'required|integer',
            'location' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'price.numeric' => 'Price must be a number',
            'members.integer' => 'Members must be a whole number',
        ];
    }

}
