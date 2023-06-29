<?php

namespace App\Http\Resources\Investment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvestorResource extends JsonResource
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
            'fullName' => $this->user->fullName,
            'status' => $this->status,
            'classification' => $this->classification->title,
            'referralCode' => $this->referralCode,
            'referralBonus' => $this->referralBonus,
            'age' => $this->age,
            'occupation' => [
                'type' => $this->occupation_type,
                'data' => $this->occupation_data,
            ],
            'createdAt' => $this->created_at->format('Y-m-d'),
        ];
    }
}
