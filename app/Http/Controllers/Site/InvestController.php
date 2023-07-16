<?php

namespace App\Http\Controllers\Site;

use App\Enums\Transactions\PaymentMethodEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Investments\SubmissionStoreRequest;
use App\Services\Investments\SubmissionService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class InvestController extends Controller
{
    public function index(): Response
    {
        return inertia('Landing/Invest/Index', [
            'paymentMethods' => PaymentMethodEnum::values(),
        ]);
    }

    public function store(SubmissionStoreRequest $request, SubmissionService $service): RedirectResponse
    {
        $service->store($request->validated());

        return to_route('site.home')
            ->with('success', 'Your investment proposal has been submitted successfully!');
    }
}
