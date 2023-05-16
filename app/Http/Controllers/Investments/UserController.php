<?php

namespace App\Http\Controllers\Investments;

use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request): Response
    {
        return inertia('Investments/Users/Index');
    }
}
