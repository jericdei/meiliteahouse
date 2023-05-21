<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;

class ProductsController extends Controller
{
    public function __invoke(Request $request): Response
    {
        return inertia('Site/Products');
    }
}