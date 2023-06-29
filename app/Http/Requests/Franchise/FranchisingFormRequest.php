<?php

namespace App\Http\Requests\Franchise;

use Illuminate\Foundation\Http\FormRequest;

class FranchisingFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'fullName' => ['required'],
            'address' => ['required'],
            'age' => ['required', 'integer', 'min:18'],
            'contactNo' => ['required', 'max:11'],
            'email' => ['required', 'email'],
            'targetLocation' => ['required'],
        ];
    }
}