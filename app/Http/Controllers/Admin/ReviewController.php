<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Notification;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of all reviews.
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        
        $query = Review::with(['user', 'product']);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $reviews = $query->latest('created_at')->paginate(15);

        $counts = [
            'all' => Review::count(),
            'pending' => Review::pending()->count(),
            'approved' => Review::approved()->count(),
            'rejected' => Review::rejected()->count(),
        ];

        return view('Admin.Reviews.reviews', compact('reviews', 'status', 'counts'));
    }

    /**
     * Display the specified review details.
     */
    public function show(Review $review)
    {
        $review->load(['user', 'product']);

        return view('Admin.Reviews.show', compact('review'));
    }

    /**
     * Approve a review.
     */
    public function approve(Review $review)
    {
        $review->update([
            'status' => 'approved',
            'reviewed_at' => now(),
        ]);

        // Notify user
        Notification::create([
            'user_id' => $review->user_id,
            'title' => 'Review Disetujui',
            'message' => "Review Anda untuk produk {$review->product->name} telah disetujui!",
            'type' => 'review_approved',
            'link' => route('notifications.index'),
            'related_review_id' => $review->id,
        ]);

        return back()->with('success', 'Review berhasil disetujui!');
    }

    /**
     * Reject a review with optional reason.
     */
    public function reject(Request $request, Review $review)
    {
        $validated = $request->validate([
            'reason' => ['nullable', 'string', 'max:500'],
        ]);

        $review->update([
            'status' => 'rejected',
            'admin_response' => $validated['reason'] ?? 'Review ditolak oleh admin',
            'reviewed_at' => now(),
        ]);

        // Notify user
        Notification::create([
            'user_id' => $review->user_id,
            'title' => 'Review Ditolak',
            'message' => "Review Anda untuk produk {$review->product->name} telah ditolak.",
            'type' => 'review_rejected',
            'link' => route('notifications.index'),
            'related_review_id' => $review->id,
        ]);

        return back()->with('success', 'Review berhasil ditolak!');
    }

    /**
     * Add response to a review.
     */
    public function respond(Request $request, Review $review)
    {
        $validated = $request->validate([
            'response' => ['required', 'string', 'max:1000'],
        ]);

        $review->update([
            'admin_response' => $validated['response'],
        ]);

        // Notify user
        Notification::create([
            'user_id' => $review->user_id,
            'title' => 'Admin Membalas Review',
            'message' => "Admin telah membalas review Anda untuk produk {$review->product->name}",
            'type' => 'admin_response',
            'link' => route('notifications.index'),
            'related_review_id' => $review->id,
        ]);

        return back()->with('success', 'Respon berhasil ditambahkan!');
    }

    /**
     * Delete a review.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return back()->with('success', 'Review berhasil dihapus!');
    }
}
