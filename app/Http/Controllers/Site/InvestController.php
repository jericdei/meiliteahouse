<?php

namespace App\Http\Controllers\Site;

use Inertia\Response;
use Illuminate\Http\Request;
use App\Enums\Transactions\PaymentMethodEnum;
use App\Enums\Investors\OccupationTypeEnum;
use App\Http\Controllers\Controller;

class InvestController extends Controller
{
    public function index(Request $request): Response
    {
        return inertia('Site/Invest/Index');
    }

    public function create(): Response
    {
        return inertia('Site/Invest/Create', [
            'paymentMethods' => PaymentMethodEnum::dropdown(),
            'occupationTypes' => OccupationTypeEnum::dropdown(),
        ]);
    }
}
