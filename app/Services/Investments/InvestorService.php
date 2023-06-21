<?php

namespace App\Services\Investments;

use App\Http\Requests\Investments\InvestorStoreRequest;
use App\Models\Investors\Investor;
use Illuminate\Support\Facades\Validator;

class InvestorService
{
    public function store(array $attributes): Investor
    {
        $validated = Validator::make($attributes, (new InvestorStoreRequest())->rules())->validated();

        // Compute referral bonus and classification
        dd($validated);

        $investor = Investor::create($validated);

        return $investor;
    }
}
