<?php

namespace App\Http\Controllers\Investments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Investments\SubmissionUpdateRequest;
use App\Http\Resources\Investments\SubmissionResource;
use App\Models\Investors\InvestorSubmission;
use App\Services\Investments\SubmissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SubmissionController extends Controller
{
    public function __construct(
        protected SubmissionService $service
    ) {
    }

    public function index(Request $request): Response
    {
        return inertia('Investments/Submissions/Index', [
            'submissions' => Inertia::lazy(function () use ($request) {
                $resource = SubmissionResource::collection(
                    InvestorSubmission::query()
                        ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
                        ->orderBy('status')
                        ->paginate($request->input('perPage', 15))
                )->response()->getData(true);

                return [
                    'items' => $resource['data'],
                    'total' => $resource['meta']['total'],
                ];
            }),
        ]);
    }

    public function update(InvestorSubmission $submission, SubmissionUpdateRequest $request): RedirectResponse
    {
        $action = $request->validated('action');
        $this->service->verify($submission, $action, $request->validated('rejectReason', null));

        return redirect()
            ->back()
            ->with('success', "Investor {$action} successful!");
    }
}
