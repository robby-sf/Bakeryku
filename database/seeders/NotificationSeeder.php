<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $hasRelatedReviewId = Schema::hasColumn('notifications', 'related_review_id');
        $hasReadAt = Schema::hasColumn('notifications', 'read_at');
        $admin = User::where('role', 'admin')->first();

        if (! $admin) {
            return;
        }

        // Get some published reviews for notification context
        $publishedReviews = Review::where('status', 'published')
            ->with(['product', 'user'])
            ->take(3)
            ->get();

        // Admin notifications: new review alerts
        foreach ($publishedReviews as $index => $review) {
            $attributes = [
                'user_id' => $admin->id,
                'title' => 'Ulasan Baru',
            ];

            $values = [
                'message' => "Ulasan baru dari {$review->user->name} untuk produk {$review->product->name}.",
                'type' => 'review',
                'link' => route('admin.reviews.show', $review->id),
                'is_read' => $index < 2, // first 2 are read
            ];

            if ($hasRelatedReviewId) {
                $attributes['related_review_id'] = $review->id;
            }

            if ($hasReadAt) {
                $values['read_at'] = $index < 2 ? now()->subDays(3) : null;
            }

            $notif = Notification::updateOrCreate($attributes, $values);
            $notif->created_at = now()->subDays(5 - $index);
            $notif->updated_at = now()->subDays(5 - $index);
            $notif->save();
        }

        // User notifications: review response from admin
        $respondedReviews = Review::where('status', 'published')
            ->whereNotNull('admin_response')
            ->with(['product', 'user'])
            ->take(3)
            ->get();

        foreach ($respondedReviews as $index => $review) {
            $attributes = [
                'user_id' => $review->user_id,
                'title' => 'Admin Merespons Ulasan Anda',
            ];

            $values = [
                'message' => "Admin merespons ulasan Anda di produk {$review->product->name}.",
                'type' => 'review',
                'link' => route('menu_view', $review->product_id),
                'is_read' => $index === 0,
            ];

            if ($hasRelatedReviewId) {
                $attributes['related_review_id'] = $review->id;
            }

            if ($hasReadAt) {
                $values['read_at'] = $index === 0 ? now()->subDays(2) : null;
            }

            $notif = Notification::updateOrCreate($attributes, $values);
            $notif->created_at = now()->subDays(4 - $index);
            $notif->updated_at = now()->subDays(4 - $index);
            $notif->save();
        }

        // System notification for admin: new order
        $orderNotif = Notification::updateOrCreate(
            [
                'user_id' => $admin->id,
                'title' => 'Pesanan Baru via WhatsApp',
            ],
            [
                'message' => 'Pelanggan Nadia Putri baru saja melakukan pesanan via WhatsApp.',
                'type' => 'order',
                'link' => route('admin.dashboard'),
                'is_read' => false,
                'read_at' => null,
            ]
        );
        $orderNotif->created_at = now()->subHours(2);
        $orderNotif->updated_at = now()->subHours(2);
        $orderNotif->save();
    }
}
