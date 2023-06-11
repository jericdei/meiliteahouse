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
            'featuredProducts' => Product::where('category_id', '!=', 4)
                ->inRandomOrder()
                ->get(),
            'locations' => [
                [
                    'id' => 1,
                    'name' => 'SM Malls',
                    'logo' => '/images/logos/sm.png',
                ],
                [
                    'id' => 2,
                    'name' => 'Ayala Malls',
                    'logo' => '/images/logos/ayala.png',
                ],
                [
                    'id' => 3,
                    'name' => 'Pamantasan ng Lungsod ng Maynila',
                    'logo' => '/images/logos/plm.png',
                ],
                [
                    'id' => 4,
                    'name' => "Robinsons' Malls",
                    'logo' => '/images/logos/robinsons.jpg',
                ],
            ],
        ]);
    }
}
