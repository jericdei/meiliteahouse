<?php

namespace App\Models\Transactions;

use App\Models\Investors\Investor;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdrawal extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'transaction_withdrawals';

    protected $guarded = [];

    // RELATIONSHIPS

    public function investor(): BelongsTo
    {
        return $this->belongsTo(Investor::class, 'investor_id');
    }
}
