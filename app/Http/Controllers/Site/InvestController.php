<?php

namespace App\Http\Controllers\Site;

use App\Enums\Investors\OccupationTypeEnum;
use App\Enums\Transactions\PaymentMethodEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Investments\SubmissionStoreRequest;
use App\Http\Resources\Investments\SubmissionResource;
use App\Models\Investors\InvestorSubmission;
use App\Services\Investments\SubmissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class InvestController extends Controller
{
    public function index(): Response
    {
        return inertia('Landing/Invest/Index');
    }

    public function form(Request $request): Response
    {
        return inertia('Site/Invest/Form', [
            'submission' => $request->has('submission_id')
                ? SubmissionResource::make(InvestorSubmission::find($request->input('submission_id')))
                : null,
            'paymentMethods' => PaymentMethodEnum::dropdown(),
            'occupationTypes' => OccupationTypeEnum::dropdown(),
        ]);
    }

    public function store(SubmissionStoreRequest $request, SubmissionService $service): RedirectResponse
    {
        $service->store($request->validated());

        return to_route('site.home')
            ->with('success', 'Your investment proposal has been submitted successfully!');
    }

    public function update(InvestorSubmission $submission, SubmissionStoreRequest $request, SubmissionService $service): RedirectResponse
    {
        $service->update($submission, $request->validated());

        return to_route('site.home')
            ->with('success', 'Your investment proposal has been resubmitted successfully!');
    }
}
