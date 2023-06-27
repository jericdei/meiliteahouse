<?php

namespace App\Services\Investments;

use App\Http\Requests\Investments\InvestmentStoreRequest;
use App\Models\Transactions\Investment;
use Illuminate\Support\Facades\Validator;

class InvestmentService
{
    public function store(array $attributes): Investment
    {
        $validated = Validator::make($attributes, (new InvestmentStoreRequest())->rules())->validated();

        return Investment::create($validated);
    }
}
