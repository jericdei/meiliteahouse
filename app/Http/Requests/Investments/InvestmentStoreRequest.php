<?php

namespace App\Http\Requests\Investments;

use App\Enums\Common\StatusEnum;
use App\Enums\Transactions\PaymentMethodEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvestmentStoreRequest extends FormRequest
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
            'amount' => ['required', 'numeric', 'min:1000'],
            'status' => ['required', Rule::in(StatusEnum::values())],
            'payment_method' => ['required', Rule::in(PaymentMethodEnum::values())],
            'reference_no' => ['required', 'string'],
            'investor_id' => ['required', 'exists:investors,id'],
        ];
    }
}
