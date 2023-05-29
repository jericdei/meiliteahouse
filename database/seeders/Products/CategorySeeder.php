<?php

namespace Database\Seeders\Products;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Products\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sizzling Rice Toppings',
                'description' => '',
            ],
            [
                'name' => 'Noodles',
                'description' => '',
            ],
            [
                'name' => 'Noodle Soup',
                'description' => '',
            ],
            [
                'name' => 'Beverages',
                'description' => '',
            ],
            [
                'name' => 'Dessert',
                'description' => '',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
}
