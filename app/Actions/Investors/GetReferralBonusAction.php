<?php

namespace App\Actions\Investors;

use App\Models\Investors\Classification;

class GetReferralBonusAction
{
    public static function execute(int|float $amount, Classification $classification): int|float
    {
        return $amount * $classification->referral_rate;
    }
}
