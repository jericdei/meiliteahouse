<?php

namespace App\Http\Controllers\Investments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Investments\SubmissionUpdateRequest;
use App\Http\Resources\Investments\SubmissionResource;
use App\Models\Investors\InvestorSubmission;
use App\Services\Investments\SubmissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class SubmissionController extends Controller
{
    public function __construct(
        protected SubmissionService $service
    ) {
    }

    public function index(Request $request): Response
    {
        $resource = SubmissionResource::collection(
            InvestorSubmission::query()
                ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
                ->latest('updated_at')
                ->orderBy('status')
                ->paginate($request->input('perPage', 15))
        )->response()->getData(true);

        return inertia('Investments/Submissions/Index', [
            'submissions' => [
                'items' => $resource['data'],
                'total' => $resource['meta']['total'],
            ],
        ]);
    }

    public function update(InvestorSubmission $submission, SubmissionUpdateRequest $request): RedirectResponse
    {
        $action = $request->validated('action');
        $this->service->verify($submission, $action, $request->validated('reject_reason', null));

        return redirect()
            ->back()
            ->with('success', "Investor {$action} successful!");
    }
}
