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
            ['nadia@example.com', 'Butter Croissant', now()->subDays(19)],
            ['nadia@example.com', 'Strawberry Shortcake', now()->subDays(14)],
            ['raka@example.com', 'Chocolate Danish', now()->subDays(9)],
            ['raka@example.com', 'Roti Abon', now()->subDays(4)],
            ['sinta@example.com', 'Mini Donut Box', now()->subDays(1)],
        ];

        foreach ($favorites as [$email, $productName, $createdAt]) {
            $user = User::where('email', $email)->first();
            $product = Product::where('name', $productName)->first();

            if (! $user || ! $product) {
                continue;
            }

            $fav = Favorite::firstOrCreate([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);

            $fav->created_at = $createdAt;
            $fav->updated_at = $createdAt;
            $fav->save();
        }
    }
}
