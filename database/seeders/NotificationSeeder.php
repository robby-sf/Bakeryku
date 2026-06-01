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
        $pendingReview = Review::where('status', 'pending')->first();

        if ($admin && $pendingReview) {
            $attributes = [
                'user_id' => $admin->id,
                'title' => 'Review Baru',
            ];

            $values = [
                'message' => "Review baru untuk produk {$pendingReview->product->name} menunggu persetujuan.",
                'type' => 'review',
                'link' => route('admin.reviews.index', ['status' => 'pending']),
                'is_read' => false,
            ];

            if ($hasRelatedReviewId) {
                $attributes['related_review_id'] = $pendingReview->id;
            }

            if ($hasReadAt) {
                $values['read_at'] = null;
            }

            Notification::updateOrCreate(
                $attributes,
                $values
            );
        }

        $approvedReview = Review::where('status', 'approved')->first();

        if ($approvedReview) {
            $attributes = [
                'user_id' => $approvedReview->user_id,
                'title' => 'Review Disetujui',
            ];

            $values = [
                'message' => "Review Anda untuk produk {$approvedReview->product->name} telah disetujui.",
                'type' => 'review',
                'link' => route('menu_view', $approvedReview->product_id),
                'is_read' => false,
            ];

            if ($hasRelatedReviewId) {
                $attributes['related_review_id'] = $approvedReview->id;
            }

            if ($hasReadAt) {
                $values['read_at'] = null;
            }

            Notification::updateOrCreate(
                $attributes,
                $values
            );
        }
    }
}
