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
        $products = Product::where('status', 'Tersedia')->get()->keyBy('name');
        $users = User::where('role', 'user')->get()->keyBy('email');

        $visits = [
            ['visitor-demo-001', 'nadia@example.com', 'Butter Croissant', '/menu/view/1', 'menu_view', now()->subDays(20)],
            ['visitor-demo-002', null, 'Butter Croissant', '/menu/view/1', 'menu_view', now()->subDays(18)],
            ['visitor-demo-003', 'raka@example.com', 'Chocolate Danish', '/menu/view/2', 'menu_view', now()->subDays(12)],
            ['visitor-demo-004', null, 'Strawberry Shortcake', '/menu/view/5', 'menu_view', now()->subDays(8)],
            ['visitor-demo-005', 'sinta@example.com', 'Mini Donut Box', '/menu/view/7', 'menu_view', now()->subDays(5)],
            ['visitor-demo-006', null, null, '/menu', 'menu', now()->subDays(3)],
            ['visitor-demo-007', 'nadia@example.com', 'Roti Sobek Susu', '/menu/view/3', 'menu_view', now()->subDay()],
            ['visitor-demo-008', null, null, '/promo', 'promo', now()],
        ];

        foreach ($visits as [$visitorId, $email, $productName, $path, $routeName, $visitedAt]) {
            $user = $email ? ($users[$email] ?? null) : null;
            $product = $productName ? ($products[$productName] ?? null) : null;

            PageVisit::updateOrCreate(
                [
                    'visitor_id' => $visitorId,
                    'path' => $path,
                    'visit_date' => $visitedAt->toDateString(),
                ],
                [
                    'user_id' => $user?->id,
                    'product_id' => $product?->id,
                    'route_name' => $routeName,
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Bakeryku Seeder',
                    'created_at' => $visitedAt,
                    'updated_at' => $visitedAt,
                ]
            );
        }
    }
}
