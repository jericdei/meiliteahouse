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
            "firstName" => ['required', 'max:30'],
            "middleName" => ['max:30'],
            "lastName" => ['required', 'max:30'],
            "contactNo" => ['required', 'max:11', 'starts_with:09'],
            "email" => ['required', 'email'],
            "age" => ['required', 'integer', 'min:18', 'max:65'],
            "referralCode" => ['max:8'],
            "occupationType" => [Rule::in(OccupationTypeEnum::values())],
            "occupationData" => ['required', 'array'],
            "occupationData.name" => ['required'],
            "occupationData.address" => ['required'],
            "occupationData.contactNo" => ['required', 'max:11', 'starts_with:09'],
            "occupationData.courseYear" => ['required_if:occupationType,student'],
            "occupationData.position" => ['required_if:occupationType,working'],
            "occupationData.workYears" => ['required_if:occupationType,working'],
            "paymentMethod" => ['required', Rule::in(PaymentMethodEnum::values())],
            "initialInvestment" => ['required', 'numeric', 'min:1000'],
            "referenceNumber" => ['required'],
            "profilePicture" => ['required', 'file', 'mimetypes:image/*'],
            "validId" => ['required', 'file', 'mimetypes:image/*'],
            "proofOfPayment" => ['required', 'file', 'mimetypes:image/*'],
        ];
    }
}
