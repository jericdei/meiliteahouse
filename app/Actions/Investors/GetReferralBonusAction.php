<?php

namespace App\Actions\Investors;

use App\Models\Investors\Investor;

class GetReferralBonusAction
{
    public static function execute(Investor $referral, int|float $amount): int|float
    {
        return $referral->referral_bonus + ($amount * $referral->classification->referral_rate);
    }
}
