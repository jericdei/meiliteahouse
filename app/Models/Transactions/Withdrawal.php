<?php

namespace App\Models\Transactions;

use App\Models\Investors\Investor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Withdrawal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaction_withdrawals';

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
