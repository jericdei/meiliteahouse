<?php

namespace App\Http\Controllers\Admin\Investments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;

class WithdrawalController extends Controller
{
    public function index(Request $request): Response
    {
        return inertia('Admin/Investments/Withdrawals/Index');
    }
}
