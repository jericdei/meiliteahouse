<?php

namespace App\Observers\Investments;

use App\Models\Investors\InvestorSubmission;

class SubmissionObserver
{
    /**
     * Handle the InvestorSubmission "created" event.
     */
    public function created(InvestorSubmission $submission): void
    {
        //
    }

    /**
     * Handle the InvestorSubmission "updated" event.
     */
    public function updated(InvestorSubmission $submission): void
    {
        //
    }

    /**
     * Handle the InvestorSubmission "deleted" event.
     */
    public function deleted(InvestorSubmission $submission): void
    {
        //
    }

    /**
     * Handle the InvestorSubmission "restored" event.
     */
    public function restored(InvestorSubmission $submission): void
    {
        //
    }

    /**
     * Handle the InvestorSubmission "force deleted" event.
     */
    public function forceDeleted(InvestorSubmission $submission): void
    {
        //
    }
}
