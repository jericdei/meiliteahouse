<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FranchisingFormResource extends JsonResource
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
            'fullName' => $this->full_name,
            'address' => $this->address,
            'age' => $this->age,
            'contactNo' => $this->contact_no,
            'email' => $this->email,
            'targetLocation' => $this->target_location,
        ];
    }
}
