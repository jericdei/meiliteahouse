<?php

namespace App\Services\Investments;

use App\Enums\Investors\OccupationTypeEnum;
use App\Enums\Transactions\PaymentMethodEnum;
use App\Models\Investors\Investor;
use App\Models\Investors\InvestorSubmission;
use App\Services\Common\FileService;
use App\Services\Users\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class SubmissionService
{
    public function __construct(protected FileService $fileService)
    {
    }

    public function store(mixed $input)
    {
        // Generate UUID
        $id = Str::orderedUuid();

        // Upload files
        $files = [
            'profile' => $input['profilePicture'],
            'id' => $input['validId'],
            'proof' => $input['proofOfPayment'],
        ];

        foreach ($files as $name => $file) {
            $this->fileService->upload("submissions/$id", $file, $name);
        }

        // Create a new submission
        InvestorSubmission::create([
            'id' => $id,
            'first_name' => $input['firstName'],
            'middle_name' => $input['middleName'],
            'last_name' => $input['lastName'],
            'contact_no' => $input['contactNo'],
            'email' => $input['email'],
            'age' => $input['age'],
            'referred_by' => $input['referralCode']
                ? Investor::referredBy($input['referralCode'])
                : null,
            'occupation_type' => OccupationTypeEnum::from($input['occupationType'])->value,
            'occupation_data' => collect($input['occupationData'])->filter()->toArray(),
            'payment_method' => PaymentMethodEnum::from($input['paymentMethod'])->value,
            'investment_amount' => $input['initialInvestment'],
            'reference_no' => $input['referenceNumber'],
        ]);
    }

    public function verify(InvestorSubmission $submission, string $action, ?string $rejectReason): void
    {
        try {
            DB::beginTransaction();

            if ($action === 'approve') {
                // Create user account
                $user = (new UserService())->store([
                    'first_name' => $submission->first_name,
                    'middle_name' => $submission->middle_name,
                    'last_name' => $submission->last_name,
                    'contact_no' => $submission->contact_no,
                    'email' => $submission->email,
                    'password' => Str::random(),
                ]);

                // Move profile photo
                Storage::move("submissions/$submission->id/profile.webp", "users/$user->id/profile.webp");

                // Create investor details
                $investor = (new InvestorService())->store([
                    'status' => 'active',
                    'referral_code' => Str::random(8),
                    'referred_by' => $submission->referred_by,
                    'age' => $submission->age,
                    'occupation_type' => $submission->occupation_type,
                    'occupation_data' => $submission->occupation_data,
                    'user_id' => $user->id,
                    'investment_amount' => $submission->investment_amount,
                ]);

                dd($investor);
                // Create transaction details

                // Update submission status to approved

                // Notify investor
            }

            // Update submission status to rejected

            // Notify investor and provide link for resubmission

            DB::commit();
        } catch (Throwable $e) {

            DB::rollBack();
            throw $e;
        }
    }
}
