<?php

namespace App\Providers;

use App\Models\Investors\InvestorSubmission;
use App\Models\Transactions\Investment;
use App\Observers\Investments\InvestmentObserver;
use App\Observers\Investments\SubmissionObserver;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Global configuration
        JsonResource::withoutWrapping();

        // Observers
        Investment::observe(InvestmentObserver::class);
        InvestorSubmission::observe(SubmissionObserver::class);
    }
}
