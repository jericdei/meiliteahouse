<?php

namespace App\Models\Transactions;

use App\Enums\Common\StatusEnum;
use App\Enums\PaymentMethodEnum;
use App\Models\Investors\Investor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaction_investments';

    protected $guarded = [];

    protected $casts = [
        'status' => StatusEnum::class,
        'payment_method' => PaymentMethodEnum::class
    ];

    # RELATIONSHIPS

    public function investor(): BelongsTo
    {
        return $this->belongsTo(Investor::class, 'investor_id');
    }
}
