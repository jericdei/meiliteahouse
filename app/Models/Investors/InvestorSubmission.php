<?php

namespace App\Models\Investors;

use App\Enums\Common\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Investors\OccupationTypeEnum;
use App\Enums\Transactions\PaymentMethodEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
