<?php

namespace App\Observers\Investments;

use App\Actions\Investors\GetClassificationAction;
use App\Actions\Investors\GetReferralBonusAction;
use App\Models\Investors\Classification;
use App\Models\Transactions\Investment;

class InvestmentObserver
{
    /**
     * Handle the Investment "created" event.
     */
    public function created(Investment $investment): void
    {
        // Update investor classification and referral bonus
        $classificationId = GetClassificationAction::execute($investment->investor);

        $investment->investor->update([
            'classification_id' => $classificationId,
            'referral_bonus' => GetReferralBonusAction::execute($investment->amount, Classification::find($classificationId)),
        ]);
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
