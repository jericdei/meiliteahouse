<?php

namespace App\Http\Controllers\Investments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;

class InvestmentController extends Controller
{
    public function index(Request $request): Response
    {
        return inertia('Investments/Investment/Index');
    }
}
