<?php

namespace App\Http\Controllers\Admin\Investments;

use App\Http\Controllers\Controller;
use App\Http\Resources\Investment\InvestmentResource;
use App\Models\Transactions\Investment;
use Illuminate\Http\Request;
use Inertia\Response;

class InvestmentController extends Controller
{
    public function index(Request $request): Response
    {
        $resource = InvestmentResource::collection(
            Investment::query()
                ->latest()
                ->paginate($request->input('perPage', 15))
        )->response()->getData(true);

        return inertia('Admin/Investments/Investments/Index', [
            'investments' => getPaginatedResourceData($resource),
        ]);
    }
}
