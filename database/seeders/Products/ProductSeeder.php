<?php

namespace Database\Seeders\Products;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Products\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Kutchay Dimsum Rice',
                'description' => 'Special Dimsum flavored with Kutchay served with Plain Rice',
                'category_id' => 1,
                'photo' => 'kutsay.png'
            ],
            [
                'name' => 'Milk Tea Chicken',
                'description' => 'Tea-brined Chicken with Milky Gravy Served with Plain Rice',
                'category_id' => 1,
                'photo' => 'milk-tea-chicken.png'
            ],
            [
                'name' => 'Chopsuey Rice',
                'description' => 'Mei Li Tea House Signature Chopsuey served with Plain Rice',
                'category_id' => 1,
                'photo' => 'chopsuey-rice.png'
            ],
            [
                'name' => 'Spring Rolls Rice Meal',
                'description' => 'Mei Li Tea House Signature Spring Rolls served with Plain Rice',
                'category_id' => 1,
                'photo' => 'spring-rolls.png'
            ],
            [
                'name' => 'Fish-Tofu Tausi Rice Meal',
                'description' => 'Mei Li Tea House Signature Fish-Tofu Tausi served with Plain Rice',
                'category_id' => 1,
                'photo' => 'fish-tofu-tausi-rice.png'
            ],
            [
                'name' => 'Calamari Rice',
                'description' => "Deep Fried Calamari with Mei Li Tea House's Signature Honey Lemon Sauce, Barbeque Sauce, or Spices",
                'category_id' => 1,
                'photo' => 'calamari-rice.png'
            ],
            [
                'name' => 'Sweet and Sour Fish',
                'description' => 'Mei Li Tea House Signature Sweet and Sour Fish served with Plain Rice',
                'category_id' => 1,
                'photo' => 'sweet-and-sour-fish.png'
            ],
            [
                'name' => 'Salt and Pepper Ribs',
                'description' => 'Mei Li Tea House Signature Salt and Pepper Ribs served with Plain Rice',
                'category_id' => 1,
                'photo' => 'salt-and-pepper-ribs.png'
            ],
            [
                'name' => 'Hong Tang Ribs',
                'description' => 'Hong Tang Ribs served with Plain Rice',
                'category_id' => 1,
                'photo' => 'hongtang-ribs.png'
            ],
            [
                'name' => 'Kung Pao Chicken Rice',
                'description' => 'Mei Li Tea House Signature Kung Pao Chicken Rice served with Plain Rice',
                'category_id' => 1,
                'photo' => 'kung-pao-chicken.png'
            ],
            [
                'name' => 'Adobo sa Kamatis',
                'description' => 'A twist in out traditional Adobo. Made with in-house adobo-tomato sauce served with Plain Rice',
                'category_id' => 1,
                'photo' => 'adobo-sa-kamatis.png'
            ],
            [
                'name' => 'Beef Ampalaya Rice',
                'description' => 'Oriental Blend of Beef and Ampalaya served with Plain Rice',
                'category_id' => 1,
                'photo' => 'beef-ampalaya.png'
            ],
            [
                'name' => 'Char Siu (Pork Asado)',
                'description' => 'Mei Li Tea House Signature Asado served with Plain Rice',
                'category_id' => 1,
                'photo' => 'pork-asado.png'
            ],
            [
                'name' => 'Lechon Macau',
                'description' => 'Mei Li Tea House Signature Lechon Macau served with Plain Rice',
                'category_id' => 1,
                'photo' => 'lechon-macau.png'
            ],
            [
                'name' => 'Lemon Chicken Rice',
                'description' => 'Mei Li Tea House Signature Lemon-flavored Chicken',
                'category_id' => 1,
                'photo' => 'lemon-chicken.png'
            ],
            [
                'name' => 'Signature Pancit',
                'description' => 'Mei Li Tea House Signature Special Pancit',
                'category_id' => 2,
                'photo' => 'signature-pancit.png'
            ],
            [
                'name' => 'Pad Thai w/ Chicken Strips',
                'description' => 'Mei Li Tea House Pad Thai Noodles made from Tamarind and Citrus Lime',
                'category_id' => 2,
                'photo' => 'pad-thai.png'
            ],
            [
                'name' => 'Chow Mien',
                'description' => 'Mei Li Tea House Signature Chow Mien',
                'category_id' => 2,
                'photo' => 'chowmien.png'
            ],
            [
                'name' => 'Wonton Noodles',
                'description' => 'Chicken Broth Soup topped with Noodles and Signature Wonton',
                'category_id' => 3,
                'photo' => 'wonton-soup.png'
            ],
            [
                'name' => 'Beef Mami',
                'description' => 'Beef Broth Soup topped with Noodles',
                'category_id' => 3,
                'photo' => 'beef-mami.png'
            ],
            [
                'name' => 'Iced Tea',
                'description' => 'Mei Li Tea House Signature Iced Tea',
                'category_id' => 4,
                'photo' => 'iced-tea.png'
            ],
            [
                'name' => 'Buchi',
                'description' => 'Fried Chinese Pastry made from Glutinous Rice Flour and coated with Sesame Seeds',
                'category_id' => 5,
                'photo' => 'buchi.png'
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => $product['description'],
                'category_id' => $product['category_id'],
                'photo' => $product['photo'],
            ]);
        }
    }
}
