<?php

namespace App\Services\Investments;

use App\Enums\Common\StatusEnum;
use App\Enums\Investors\OccupationTypeEnum;
use App\Enums\Transactions\PaymentMethodEnum;
use App\Models\Investors\Investor;
use App\Models\Investors\InvestorSubmission;
use App\Notifications\Investments\SubmissionApproved;
use App\Notifications\Investments\SubmissionDeclined;
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
        try {
            DB::beginTransaction();

            // Generate UUID
            $id = Str::orderedUuid();

            // Upload files
            $this->uploadFiles($input, $id);

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
                'occupation_type' => OccupationTypeEnum::from($input['occupation']['type'])->value,
                'occupation_data' => collect($input['occupation']['data'])->filter()->toArray(),
                'payment_method' => PaymentMethodEnum::from($input['initialInvestment']['paymentMethod'])->value,
                'investment_amount' => $input['initialInvestment']['amount'],
                'reference_no' => $input['initialInvestment']['referenceNumber'],
            ]);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();

            throw $e;
        }
    }

    public function update(InvestorSubmission $submission, mixed $input): void
    {
        try {
            DB::beginTransaction();

            $referredBy = Investor::referredBy($input['referralCode']);

            // Upload files
            $this->uploadFiles($input, $submission->id);

            $submission->update([
                'first_name' => $input['firstName'],
                'middle_name' => $input['middleName'],
                'last_name' => $input['lastName'],
                'contact_no' => $input['contactNo'],
                'email' => $input['email'],
                'age' => $input['age'],
                'referred_by' => $referredBy ? $referredBy->id : null,
                'occupation_type' => $input['occupation']['type'],
                'occupation_data' => $input['occupation']['data'],
                'investment_amount' => $input['initialInvestment']['amount'],
                'reference_no' => $input['initialInvestment']['referenceNumber'],
                'payment_method' => $input['initialInvestment']['paymentMethod'],
                'status' => StatusEnum::PENDING->value,
            ]);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function uploadFiles(array $input, string $id): void
    {
        $files = [
            'profile' => $input['profilePicture'],
            'id' => $input['validId'],
            'proof' => $input['proofOfPayment'],
        ];

        foreach ($files as $name => $file) {
            $this->fileService->upload("submissions/$id", $file, $name);
        }
    }

    public function verify(InvestorSubmission $submission, string $action, ?string $rejectReason): void
    {
        try {
            DB::beginTransaction();

            if ($action === 'approve') {
                $password = Str::random();

                // Create user account
                $user = (new UserService())->store([
                    'first_name' => $submission->first_name,
                    'middle_name' => $submission->middle_name,
                    'last_name' => $submission->last_name,
                    'contact_no' => $submission->contact_no,
                    'email' => $submission->email,
                    'password' => $password,
                ]);

                // Assign role to investor
                $user->assignRole('investor');

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
                ]);

                // Move valid ID photo
                Storage::move("submissions/$submission->id/id.webp", "investors/$investor->id/id.webp");

                // Create transaction details
                $investment = (new InvestmentService())->store([
                    'amount' => $submission->investment_amount,
                    'status' => StatusEnum::APPROVED->value,
                    'payment_method' => $submission->payment_method,
                    'reference_no' => $submission->reference_no,
                    'investor_id' => $investor->id,
                ]);

                // Move proof of payment photo
                Storage::move("submissions/$submission->id/proof.webp", "investments/$investment->id/proof.webp");

                // Remove submission folder
                Storage::deleteDirectory("submissions/$submission->id");

                // Update submission status to approved
                $submission->update([
                    'status' => StatusEnum::APPROVED->value,
                ]);

                // Notify investor
                $submission->notify(new SubmissionApproved($investor, $password));
            } else {
                // Update submission status to rejected
                $submission->update([
                    'status' => StatusEnum::DECLINED->value,
                ]);

                $submission->notify(new SubmissionDeclined($submission, $rejectReason));
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
