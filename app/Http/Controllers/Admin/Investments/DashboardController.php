<?php

namespace App\Http\Controllers\Admin\Investments;

use App\Http\Controllers\Controller;
use App\Models\Investors\Investor;
use App\Models\Investors\InvestorSubmission;
use Illuminate\Http\Request;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {
        return inertia('Admin/Investments/Dashboard', [
            'headers' => [
                'activeInvestors' => Investor::active()->count(),
                'pendingSubmissions' => InvestorSubmission::pending()->count(),
                'pendingTransactions' => 0,
            ],
        ]);
    }
}
