<?php

namespace App\Http\Controllers\System\Franchise;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\FranchisingFormResource;
use App\Models\Franchise\FranchisingSubmission;
use Illuminate\Http\Request;
use Inertia\Response;

class SubmissionController extends Controller
{
    public function index(Request $request): Response
    {
        return inertia('System/Franchise/Submissions/Index', [
            'submissions' => getPaginatedResourceData(FranchisingFormResource::collection(
                FranchisingSubmission::query()
                    ->latest()
                    ->paginate($request->input('perPage', 15))
            )->response()->getData(true)),
        ]);
    }
}
