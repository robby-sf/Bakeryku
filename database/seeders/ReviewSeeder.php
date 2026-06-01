<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $hasAdminResponse = Schema::hasColumn('reviews', 'admin_response');
        $hasReviewedAt = Schema::hasColumn('reviews', 'reviewed_at');

        $reviews = [
            ['nadia@example.com', 'Butter Croissant', 5, 'Croissantnya renyah dan buttery banget.', 'approved', 'Terima kasih sudah mencoba menu favorit kami!', now()->subDays(6)],
            ['raka@example.com', 'Chocolate Danish', 4, 'Cokelatnya enak, porsinya pas.', 'approved', null, now()->subDays(5)],
            ['sinta@example.com', 'Strawberry Shortcake', 5, 'Creamnya ringan dan stroberinya segar.', 'approved', 'Senang sekali kamu suka shortcake kami.', now()->subDays(4)],
            ['nadia@example.com', 'Roti Sobek Susu', 4, 'Teksturnya empuk, cocok buat keluarga.', 'pending', null, null],
            ['raka@example.com', 'Mini Donut Box', 3, 'Variasi toppingnya menarik, tapi agak kemanisan.', 'rejected', 'Terima kasih masukannya, review ini kami arsipkan untuk evaluasi internal.', now()->subDays(2)],
        ];

        foreach ($reviews as [$email, $productName, $rating, $comment, $status, $adminResponse, $reviewedAt]) {
            $user = User::where('email', $email)->first();
            $product = Product::where('name', $productName)->first();

            if (! $user || ! $product) {
                continue;
            }

            $values = [
                'rating' => $rating,
                'status' => $status,
            ];

            if ($hasAdminResponse) {
                $values['admin_response'] = $adminResponse;
            }

            if ($hasReviewedAt) {
                $values['reviewed_at'] = $reviewedAt;
            }

            Review::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'comment' => $comment,
                ],
                $values
            );
        }
    }
}
