<?php

namespace App\Models\Investors;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value)
        );
    }

    public function occupationType(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value)
        );
    }

    public function getFullNameAttribute(): string
    {
        return "$this->first_name $this->last_name";
    }

    // SCOPES

    public function scopePending(): Builder
    {
        return $this->where('status', 'pending');
    }
}
