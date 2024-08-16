<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
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
            'name' => 'required',
            // 'email' => 'required|email|unique:contacts,email',
            'email' => [
                'required',
                'email',
                Rule::unique('contacts', 'email')->ignore($this->id),
            ],
            'phone' => 'sometimes|max:15',
            'address' => 'sometimes|max:100',
        ];
    }
}
