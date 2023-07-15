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
            'fullName' => ['required', 'max:30'],
            'address' => ['required'],
            'contactNo' => ['required', 'unique:users,contact_no'],
            'email' => ['required', 'email', 'unique:users,email'],
            'age' => ['required', 'integer', 'min:18', 'max:65'],
            'referralCode' => ['max:8'],
            'occupation.type' => [Rule::in(OccupationTypeEnum::values())],
            'occupation.data' => ['required', 'array'],
            'occupation.data.name' => ['required'],
            'occupation.data.address' => ['required'],
            'occupation.data.contactNo' => ['required'],
            'occupation.data.courseYear' => ['required_if:occupationType,student'],
            'occupation.data.position' => ['required_if:occupationType,working'],
            'occupation.data.workYears' => ['required_if:occupationType,working'],
            'initialInvestment.paymentMethod' => ['required', Rule::in(PaymentMethodEnum::values())],
            'initialInvestment.amount' => ['required', 'numeric', 'min:1000'],
            'initialInvestment.referenceNumber' => ['required'],
            'profilePicture' => ['required', 'file', 'mimetypes:image/*'],
            'validId' => ['required', 'file', 'mimetypes:image/*'],
            'proofOfPayment' => ['required', 'file', 'mimetypes:image/*'],
        ];
    }
}
