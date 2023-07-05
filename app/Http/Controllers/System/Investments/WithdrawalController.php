<?php

namespace App\Http\Controllers\System\Investments;

use App\Http\Controllers\Controller;
use App\Http\Resources\Investment\WithdrawalResource;
use App\Models\Transactions\Withdrawal;
use Illuminate\Http\Request;
use Inertia\Response;

class WithdrawalController extends Controller
{
    public function index(Request $request): Response
    {
        $resource = WithdrawalResource::collection(
            Withdrawal::query()
                ->latest()
                ->paginate($request->input('perPage', 15))
        )->response()->getData(true);

        return inertia('System/Investments/Withdrawals/Index', [
            'withdrawals' => getPaginatedResourceData($resource),
        ]);
    }
}
