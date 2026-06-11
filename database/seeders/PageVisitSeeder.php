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

        // This week: 0 days ago (or today) -> ~12 visits
        for ($i = 0; $i < 12; $i++) {
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
