<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'firstName' => $this->first_name,
            'middle_name' => $this->middle_name,
            'lastName' => $this->last_name,
            'fullName' => $this->full_name,
            'initials' => $this->initials,
            'role' => $this->roles->pluck('name')->first(),
            'contactNo' => $this->contact_no,
            'email' => $this->email,
            'createdAt' => $this->created_at->diffForHumans(),
            'updatedAt' => $this->updated_at->diffForHumans(),
        ];
    }
}
