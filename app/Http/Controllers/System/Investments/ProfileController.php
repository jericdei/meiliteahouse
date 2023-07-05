<?php

namespace App\Http\Controllers\System\Investments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;

class ProfileController extends Controller
{
    public function __invoke(Request $request): Response
    {
        return inertia('System/Investments/Profile');
    }
}
