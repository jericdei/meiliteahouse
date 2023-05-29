<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Products\Product;
use Illuminate\Http\Request;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(Request $request): Response
    {
        return inertia('Site/Index', [
            'featuredProducts' => Product::inRandomOrder()->limit(8)->get()->toArray()
        ]);
    }
}
