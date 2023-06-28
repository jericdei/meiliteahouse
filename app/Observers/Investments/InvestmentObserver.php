<?php

namespace App\Observers\Investments;

use App\Actions\Investors\GetClassificationAction;
use App\Actions\Investors\GetReferralBonusAction;
use App\Enums\Common\StatusEnum;
use App\Models\Transactions\Investment;

class InvestmentObserver
{
    /**
     * Handle the Investment "created" event.
     */
    public function created(Investment $investment): void
    {
        $investor = $investment->investor;

        // Update investor's classification
        $investor->update([
            'classification_id' => (GetClassificationAction::execute($investor))->id,
        ]);

        // If investment is approved, add referral bonus to referral if exists
        if ($investor->referral && $investment->status === StatusEnum::APPROVED->value) {
            $referral = $investor->referral;

            $referral->update([
                'referral_bonus' => GetReferralBonusAction::execute($referral, $investment->amount),
            ]);
        }
    }

    /**
     * Handle the Investment "updated" event.
     */
    public function updated(Investment $investment): void
    {
        //
    }

    /**
     * Handle the Investment "deleted" event.
     */
    public function deleted(Investment $investment): void
    {
        //
    }

    /**
     * Handle the Investment "restored" event.
     */
    public function restored(Investment $investment): void
    {
        //
    }

    /**
     * Handle the Investment "force deleted" event.
     */
    public function forceDeleted(Investment $investment): void
    {
        //
    }
}
