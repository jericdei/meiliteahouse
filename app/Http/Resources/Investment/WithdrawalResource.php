<?php

namespace App\Http\Resources\Investment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'investor' => $this->investor->user->full_name,
            'amount' => $this->amount,
            'status' => $this->status,
            'paymentMethod' => $this->payment_method,
            'accountNumber' => $this->account_number,
            'createdAt' => $this->created_at->format('Y-m-d'),
        ];
    }
}
