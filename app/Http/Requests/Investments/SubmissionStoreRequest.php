<?php

namespace App\Http\Requests\Investments;

use App\Enums\Investors\OccupationTypeEnum;
use App\Enums\Transactions\PaymentMethodEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubmissionStoreRequest extends FormRequest
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
            'firstName' => ['required', 'max:30'],
            'middleName' => ['max:30'],
            'lastName' => ['required', 'max:30'],
            'address' => ['required'],
            'age' => ['required', 'integer', 'min:18', 'max:65'],
            'contactNo' => ['required', 'unique:users,contact_no'],
            'email' => ['required', 'email', 'unique:users,email'],
            'referralCode' => ['max:8'],
            'occupation.type' => ['required', Rule::in(OccupationTypeEnum::values())],
            'occupation.data' => ['required', 'array'],
            'occupation.data.name' => ['required'],
            'occupation.data.address' => ['required'],
            'occupation.data.contactNo' => ['required'],
            'occupation.data.courseYear' => ['required_if:occupation.type,student'],
            'occupation.data.position' => ['required_if:occupation.type,working'],
            'occupation.data.workYears' => ['required_if:occupation.type,working'],
            'initialInvestment.paymentMethod' => ['required', Rule::in(PaymentMethodEnum::values())],
            'initialInvestment.amount' => ['required', 'numeric', 'min:1000'],
            'initialInvestment.referenceNumber' => ['required'],
            'validId' => ['required', 'file', 'mimetypes:image/*'],
            'proofOfPayment' => ['required', 'file', 'mimetypes:image/*'],
        ];
    }
}
