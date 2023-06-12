<?php

namespace App\Http\Controllers\Investments;

use App\Http\Controllers\Controller;
use App\Http\Resources\Investments\SubmissionResource;
use App\Models\Investors\InvestorSubmission;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SubmissionController extends Controller
{
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
}
