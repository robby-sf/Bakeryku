<?php

namespace Database\Seeders;

use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    public function run(): void
    {
        $favorites = [
            ['nadia@example.com', 'Butter Croissant'],
            ['nadia@example.com', 'Strawberry Shortcake'],
            ['raka@example.com', 'Chocolate Danish'],
            ['raka@example.com', 'Roti Abon Pedas'],
            ['sinta@example.com', 'Mini Donut Box'],
        ];

        foreach ($favorites as [$email, $productName]) {
            $user = User::where('email', $email)->first();
            $product = Product::where('name', $productName)->first();

            if (! $user || ! $product) {
                continue;
            }

            Favorite::firstOrCreate([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
        }
    }
}
