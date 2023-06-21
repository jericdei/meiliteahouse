<?php

namespace App\Http\Requests\Investments;

use App\Enums\Investors\InvestorStatusEnum;
use App\Enums\Investors\OccupationTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvestorStoreRequest extends FormRequest
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
            'status' => ['required', Rule::in(InvestorStatusEnum::values())],
            'referral_code' => ['required', 'string', 'max:8'],
            'referred_by' => ['nullable', 'exists:investors,id'],
            'age' => ['required', 'integer', 'min:18', 'max:65'],
            'occupation_type' => ['required', Rule::in(OccupationTypeEnum::values())],
            'occupation_data' => ['required', 'array'],
            'user_id' => ['required', 'exists:users,id'],
            'investment_amount' => ['required', 'numeric', 'min:1000'],
        ];
    }
}
