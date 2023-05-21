<?php

namespace App\Http\Controllers\Site;

use Inertia\Response;
use App\Http\Controllers\Controller;
use App\Enums\Investors\OccupationTypeEnum;
use App\Enums\Transactions\PaymentMethodEnum;
use App\Services\Investments\SubmissionService;
use App\Http\Requests\Investments\SubmissionStoreRequest;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

class InvestController extends Controller
{
    public function index(): Response
    {
        return inertia('Site/Invest/Index');
    }

    public function form(): Response
    {
        return inertia('Site/Invest/Form', [
            'paymentMethods' => PaymentMethodEnum::dropdown(),
            'occupationTypes' => OccupationTypeEnum::dropdown(),
        ]);
    }

    public function store(SubmissionStoreRequest $request, SubmissionService $service)
    {
        $service->store($request->validated());

        return redirect()
            ->back()
            ->with('success', 'Your investment proposal has been submitted successfully!');
    }
}
