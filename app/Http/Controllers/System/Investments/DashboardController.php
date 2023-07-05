<?php

namespace App\Http\Controllers\System\Investments;

use App\Enums\Common\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Investors\Investor;
use App\Models\Investors\InvestorSubmission;
use App\Models\Transactions\Investment;
use App\Models\Transactions\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $data = [
                'component' => 'System/Investments/Dashboard',
                'props' => [
                    'headers' => [
                        'activeInvestors' => Investor::active()->count(),
                        'pendingSubmissions' => InvestorSubmission::pending()->count(),
                        'pendingTransactions' => Investment::where('status', StatusEnum::PENDING->value)->count() + Withdrawal::where('status', StatusEnum::PENDING->value)->count(),
                    ],
                ],
            ];
        } else {
            $investor = Investor::query()->where('user_id', $user->id)->first();

            $data = [
                'component' => 'System/Investments/InvestorDashboard',
                'props' => [
                    'headers' => [
                        'totalInvestment' => $investor->total_investments,
                        'referralBonus' => $investor->referral_bonus,
                    ],
                ],
            ];
        }

        return inertia($data['component'], $data['props']);
    }
}
