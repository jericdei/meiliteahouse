<?php

namespace App\Http\Requests\Investments;

use Illuminate\Foundation\Http\FormRequest;

class SubmissionUpdateRequest extends FormRequest
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
            'action' => ['required', 'in:approve,reject'],
            'reject_reason' => ['sometimes', 'string'],
        ];
    }
}
