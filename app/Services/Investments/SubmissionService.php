<?php

namespace App\Services\Investments;

use App\Enums\Investors\OccupationTypeEnum;
use App\Enums\Transactions\PaymentMethodEnum;
use App\Models\Investors\Investor;
use Illuminate\Support\Str;
use App\Models\Investors\InvestorSubmission;
use App\Services\Common\FileService;

class SubmissionService
{
    public function __construct(protected FileService $fileService) {}

    public function store(mixed $input)
    {
        $id = Str::orderedUuid();

        foreach ([
            "profile" => $input['profilePicture'],
            "id" => $input['validId'],
            "proof" => $input['proofOfPayment']
        ] as $name => $file) {
            $this->fileService->upload("submissions/$id", $file, $name);
        }

        InvestorSubmission::create([
            'id' => $id,
            'first_name' => $input['firstName'],
            'middle_name' => $input['middleName'],
            'last_name' => $input['lastName'],
            'contact_no' => $input['contactNo'],
            'email' => $input['email'],
            'age' => $input['age'],
            'referred_by' => Investor::referredBy($input['referralCode']),
            'occupation_type' => OccupationTypeEnum::from($input['occupationType']),
            'occupation_data' => collect($input['occupationData'])->filter()->toArray(),
            'payment_method' => PaymentMethodEnum::from($input['paymentMethod']),
            'investment_amount' => $input['initialInvestment'],
            'reference_no' => $input['referenceNumber']
        ]);
    }
}
