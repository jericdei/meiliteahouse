<?php

namespace App\Http\Controllers\Admin\Investments;

use App\Http\Controllers\Controller;
use App\Http\Resources\Investment\InvestorResource;
use App\Models\Investors\Investor;
use Illuminate\Http\Request;
use Inertia\Response;

class InvestorController extends Controller
{
    public function index(Request $request): Response
    {
        $resource = InvestorResource::collection(
            Investor::query()
                ->latest()
                ->paginate($request->input('perPage', 15))
        )->response()->getData(true);

        return inertia('Admin/Investments/Investors/Index', [
            'investors' => getPaginatedResourceData($resource),
        ]);
    }
}
