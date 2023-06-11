<?php

namespace App\Http\Resources\Investments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubmissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'firstName' => $this->first_name,
            'middleName' => $this->middle_name,
            'lastName' => $this->last_name,
            'fullName' => $this->full_name,
            'contactNo' => $this->contact_no,
            'email' => $this->email,
            'age' => $this->age,
            'referredBy' => ! is_null($this->referral)
                ? $this->referral->user->name
                : null,
            'occupation' => [
                'type' => $this->occupation_type,
                'data' => $this->occupation_data,
            ],
            'initialInvestment' => [
                'paymentMethod' => $this->payment_method,
                'amount' => $this->investment_amount,
                'referenceNumber' => $this->reference_no,
            ],
        ];
    }
}
