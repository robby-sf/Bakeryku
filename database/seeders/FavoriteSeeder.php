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
            ['nadia@example.com', 'Roll Cake', now()->subDays(19)],
            ['nadia@example.com', 'Roti Tawar Pandan', now()->subDays(14)],
            ['nadia@example.com', 'Kue Mandarin', now()->subDays(8)],
            ['raka@example.com', 'Roti Choco Boat', now()->subDays(9)],
            ['raka@example.com', 'Roti Abon', now()->subDays(4)],
            ['raka@example.com', 'Chiffon Cake Big', now()->subDays(6)],
            ['sinta@example.com', 'Donat Meses', now()->subDays(1)],
            ['sinta@example.com', 'Roti Pisang Coklat', now()->subDays(5)],
            ['sinta@example.com', 'Blueberry Cheese', now()->subDays(3)],
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
