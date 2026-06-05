<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Butter Croissant',
                'category' => 'Pastry',
                'price' => 18000,
                'description' => 'Croissant berlapis dengan aroma butter yang ringan dan renyah.',
                'status' => 'Tersedia',
            ],
            [
                'name' => 'Chocolate Danish',
                'category' => 'Chocolate',
                'price' => 22000,
                'description' => 'Pastry lembut dengan isian cokelat premium.',
                'status' => 'Tersedia',
            ],
            [
                'name' => 'Roti Sobek Susu',
                'category' => 'Bread',
                'price' => 28000,
                'description' => 'Roti sobek empuk dengan rasa susu yang creamy.',
                'status' => 'Tersedia',
            ],
            [
                'name' => 'Roti Abon Pedas',
                'category' => 'Roti Asin',
                'price' => 24000,
                'description' => 'Roti gurih dengan topping abon dan saus pedas manis.',
                'status' => 'Tersedia',
            ],
            [
                'name' => 'Strawberry Shortcake',
                'category' => 'Cakes',
                'price' => 45000,
                'description' => 'Cake vanilla lembut dengan krim segar dan potongan stroberi.',
                'status' => 'Tersedia',
            ],
            [
                'name' => 'Tiramisu Slice',
                'category' => 'Cakes',
                'price' => 42000,
                'description' => 'Tiramisu klasik dengan rasa kopi yang seimbang.',
                'status' => 'Tersedia',
            ],
            [
                'name' => 'Mini Donut Box',
                'category' => 'Assorted',
                'price' => 36000,
                'description' => 'Kotak berisi donat mini dengan berbagai topping.',
                'status' => 'Tersedia',
            ],
            [
                'name' => 'Cheese Garlic Bread',
                'category' => 'Bread',
                'price' => 30000,
                'description' => 'Roti panggang dengan butter garlic dan lelehan keju.',
                'status' => 'Habis',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                array_merge([
                    'image' => null,
                    'image_2' => null,
                    'image_3' => null,
                ], $product)
            );
        }
    }
}
