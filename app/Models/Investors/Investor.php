<?php

namespace App\Models\Investors;

use App\Models\Users\User;
use App\Enums\Common\StatusEnum;
use App\Enums\OccupationTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Investor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'investors';

    protected $guarded = [];

    protected $casts = [
        'status' => StatusEnum::class,
        'occupation_type' => OccupationTypeEnum::class,
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
}
