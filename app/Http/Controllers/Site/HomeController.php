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
                ->limit(8)
                ->get(),
            'locations' => [
                [
                    'id' => 1,
                    'name' => 'SM Keme',
                    'logo' => asset('images/logos/sm.png'),
                    'address' => 'Address',
                ],
                [
                    'id' => 2,
                    'name' => 'Ayala Malls',
                    'logo' => asset('images/logos/ayala.png'),
                    'address' => 'Address',
                ],
                [
                    'id' => 3,
                    'name' => 'Pamantasan ng Lungsod ng Maynila',
                    'logo' => asset('images/logos/plm.png'),
                    'address' => 'Address',
                ],
                [
                    'id' => 4,
                    'name' => "Robinson's",
                    'logo' => asset('images/logos/robinsons.jpg'),
                    'address' => 'Address',
                ]
            ]
        ]);
    }
}
