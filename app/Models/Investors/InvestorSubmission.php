<?php

namespace App\Models\Investors;

use App\Enums\Common\StatusEnum;
use App\Enums\OccupationTypeEnum;
use App\Enums\PaymentMethodEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvestorSubmission extends Model
{
    use HasFactory;

    protected $table = 'investor_submissions';

    protected $guarded = [];

    protected $casts = [
        'status' => StatusEnum::class,
        'occupation_type' => OccupationTypeEnum::class,
        'occupation_data' => 'array',
        'payment_method' => PaymentMethodEnum::class
    ];

    # RELATIONSHIPS

    public function referral(): BelongsTo
    {
        return $this->belongsTo(Investor::class, 'referred_by');
    }

}
