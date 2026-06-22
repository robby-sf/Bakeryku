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
            'published' => Review::published()->count(),
            'hidden' => Review::hidden()->count(),
        ];

        return view('admin.reviews.reviews', compact('reviews', 'status', 'counts'));
    }

    /**
     * Display the specified review details.
     */
    public function show(Review $review)
    {
        $review->load(['user', 'product']);

        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Hide a review (make it invisible to public).
     */
    public function hide(Review $review)
    {
        $review->update([
            'status' => 'hidden',
        ]);

        // Notify user
        Notification::create([
            'user_id' => $review->user_id,
            'title' => 'Review Disembunyikan',
            'message' => "Review Anda untuk produk {$review->product->name} telah disembunyikan oleh admin.",
            'type' => 'review_hidden',
            'link' => route('notifications.index'),
            'related_review_id' => $review->id,
        ]);

        return back()->with('success', 'Review berhasil disembunyikan!');
    }

    /**
     * Unhide a review (make it visible to public again).
     */
    public function unhide(Review $review)
    {
        $review->update([
            'status' => 'published',
        ]);

        // Notify user
        Notification::create([
            'user_id' => $review->user_id,
            'title' => 'Review Ditampilkan Kembali',
            'message' => "Review Anda untuk produk {$review->product->name} telah ditampilkan kembali.",
            'type' => 'review_unhidden',
            'link' => route('notifications.index'),
            'related_review_id' => $review->id,
        ]);

        return back()->with('success', 'Review berhasil ditampilkan kembali!');
    }

    /**
     * Add response/reply to a review.
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

        return back()->with('success', 'Balasan berhasil ditambahkan!');
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
