<?php

namespace Database\Seeders;

use App\Models\PageVisit;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class PageVisitSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::where('status', 'Tersedia')->get();
        $users = User::where('role', 'user')->get();

        if ($products->isEmpty() || $users->isEmpty()) {
            return;
        }

        $visitData = [];

        // --- Landing Page visits ---
        for ($i = 0; $i < 30; $i++) {
            $daysAgo = rand(0, 21);
            $visitData[] = [
                'visitor_id' => 'visitor-landing-' . $i,
                'user_id' => rand(0, 2) ? null : $users->random()->id,
                'product_id' => null,
                'path' => '/',
                'route_name' => 'landing_page',
                'created_at' => now()->subDays($daysAgo)->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
            ];
        }

        // --- Menu Page visits ---
        for ($i = 0; $i < 20; $i++) {
            $daysAgo = rand(0, 21);
            $visitData[] = [
                'visitor_id' => 'visitor-menu-' . $i,
                'user_id' => rand(0, 1) ? $users->random()->id : null,
                'product_id' => null,
                'path' => '/menu',
                'route_name' => 'menu',
                'created_at' => now()->subDays($daysAgo)->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
            ];
        }

        // --- Store Page visits ---
        for ($i = 0; $i < 10; $i++) {
            $daysAgo = rand(0, 21);
            $visitData[] = [
                'visitor_id' => 'visitor-store-' . $i,
                'user_id' => rand(0, 1) ? $users->random()->id : null,
                'product_id' => null,
                'path' => '/stores',
                'route_name' => 'store',
                'created_at' => now()->subDays($daysAgo)->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
            ];
        }

        // --- Promo Page visits ---
        for ($i = 0; $i < 8; $i++) {
            $daysAgo = rand(0, 14);
            $visitData[] = [
                'visitor_id' => 'visitor-promo-' . $i,
                'user_id' => rand(0, 1) ? $users->random()->id : null,
                'product_id' => null,
                'path' => '/promo',
                'route_name' => 'promo',
                'created_at' => now()->subDays($daysAgo)->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
            ];
        }

        // --- Product View visits ---

        // Week 3 ago: subDays 15 to 21 -> ~18 visits
        for ($i = 0; $i < 18; $i++) {
            $daysAgo = rand(15, 21);
            $product = $products->random();
            $visitData[] = [
                'visitor_id' => 'visitor-w3-' . $i,
                'user_id' => rand(0, 1) ? $users->random()->id : null,
                'product_id' => $product->id,
                'path' => '/menu/view/' . $product->id,
                'route_name' => 'menu_view',
                'created_at' => now()->subDays($daysAgo)->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
            ];
        }

        // Week 2 ago: subDays 8 to 14 -> ~22 visits
        for ($i = 0; $i < 22; $i++) {
            $daysAgo = rand(8, 14);
            $product = $products->random();
            $visitData[] = [
                'visitor_id' => 'visitor-w2-' . $i,
                'user_id' => rand(0, 1) ? $users->random()->id : null,
                'product_id' => $product->id,
                'path' => '/menu/view/' . $product->id,
                'route_name' => 'menu_view',
                'created_at' => now()->subDays($daysAgo)->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
            ];
        }

        // Week 1 ago: subDays 1 to 7 -> ~45 visits
        for ($i = 0; $i < 45; $i++) {
            $daysAgo = rand(1, 7);
            $product = $products->random();
            $visitData[] = [
                'visitor_id' => 'visitor-w1-' . $i,
                'user_id' => rand(0, 1) ? $users->random()->id : null,
                'product_id' => $product->id,
                'path' => '/menu/view/' . $product->id,
                'route_name' => 'menu_view',
                'created_at' => now()->subDays($daysAgo)->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
            ];
        }

        // This week: 0 days ago (today) -> ~15 visits
        for ($i = 0; $i < 15; $i++) {
            $product = $products->random();
            $visitData[] = [
                'visitor_id' => 'visitor-w0-' . $i,
                'user_id' => rand(0, 1) ? $users->random()->id : null,
                'product_id' => $product->id,
                'path' => '/menu/view/' . $product->id,
                'route_name' => 'menu_view',
                'created_at' => now()->subHours(rand(0, 12))->subMinutes(rand(0, 59)),
            ];
        }

        foreach ($visitData as $data) {
            PageVisit::create([
                'visitor_id' => $data['visitor_id'],
                'user_id' => $data['user_id'],
                'product_id' => $data['product_id'],
                'path' => $data['path'],
                'route_name' => $data['route_name'],
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Bakeryku Seeder',
                'visit_date' => $data['created_at']->toDateString(),
                'created_at' => $data['created_at'],
                'updated_at' => $data['created_at'],
            ]);
        }
    }
}
