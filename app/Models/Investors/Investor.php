<?php

namespace App\Models\Investors;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investor extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'investors';

    protected $guarded = [];

    protected $casts = [
        'occupation_data' => 'array',
    ];

    // RELATIONSHIPS

    public function referral(): BelongsTo
    {
        return $this->belongsTo($this, 'referred_by');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function classification(): BelongsTo
    {
        return $this->belongsTo(Classification::class, 'classification_id');
    }

    // SCOPES

    public static function referredBy(string $referralCode): self|null
    {
        $investor = self::where('referral_code', $referralCode)->first();

        return $investor
            ? $investor->id
            : null;
    }

    public function scopeActive(): Builder
    {
        return $this->where('status', 'active');
    }
}
