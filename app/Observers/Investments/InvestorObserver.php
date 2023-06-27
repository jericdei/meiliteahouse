<?php

namespace App\Observers\Investments;

use App\Models\Investors\Investor;

class InvestorObserver
{
    /**
     * Handle the Investor "created" event.
     */
    public function created(Investor $investor): void
    {
        //
    }

    /**
     * Handle the Investor "updated" event.
     */
    public function updated(Investor $investor): void
    {
        //
    }

    /**
     * Handle the Investor "deleted" event.
     */
    public function deleted(Investor $investor): void
    {
        //
    }

    /**
     * Handle the Investor "restored" event.
     */
    public function restored(Investor $investor): void
    {
        //
    }

    /**
     * Handle the Investor "force deleted" event.
     */
    public function forceDeleted(Investor $investor): void
    {
        //
    }
}
