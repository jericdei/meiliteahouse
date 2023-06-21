<?php

namespace App\Models\Investors;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvestorSubmission extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'investor_submissions';

    protected $guarded = [];

    protected $casts = [
        'occupation_data' => 'array',
    ];

    // RELATIONSHIPS

    public function referral(): BelongsTo
    {
        return $this->belongsTo(Investor::class, 'referred_by');
    }

    public function getFullNameAttribute(): string
    {
        return "$this->first_name $this->middle_name $this->last_name";
    }

    // SCOPES
    public function scopePending(): Builder
    {
        return $this->where('status', 'pending');
    }
}
