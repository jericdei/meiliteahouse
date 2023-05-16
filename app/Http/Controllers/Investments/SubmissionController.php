<?php

namespace App\Http\Controllers\Investments;

use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubmissionController extends Controller
{
    public function index(Request $request): Response
    {
        return inertia('Investments/Submissions/Index');
    }
}
