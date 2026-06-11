<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly created review in storage.
     * Review is published immediately — no admin approval needed.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $userId = Auth::guard('user')->id();

        // Check if user already reviewed this product
        $existingReview = Review::where('user_id', $userId)
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Anda sudah memberikan ulasan untuk produk ini.');
        }

        $validated['user_id'] = $userId;
        $validated['status'] = 'published'; // Langsung tampil, tanpa approval
        $review = Review::create($validated);

        // Create notification for admin
        $product = Product::find($validated['product_id']);
        $adminId = User::where('role', 'admin')->value('id') ?: 1;

        Notification::create([
            'user_id' => $adminId,
            'title' => 'Review Baru',
            'message' => "User telah menambahkan review untuk produk {$product->name}",
            'type' => 'review',
            'link' => route('admin.reviews.index'),
            'related_review_id' => $review->id,
        ]);

        \App\Models\ActivityLog::log('review', 'Ulasan baru pada produk ' . $product->name, "Pengguna " . Auth::guard('user')->user()->name . " memberikan ulasan bintang {$review->rating}.", $userId);

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
    }

    /**
     * Update the specified review.
     */
    public function update(Request $request, Review $review)
    {
        // Check authorization
        if ($review->user_id !== Auth::guard('user')->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $review->update($validated);

        return response()->json(['message' => 'Review berhasil diperbarui!', 'review' => $review]);
    }

    /**
     * Delete the specified review.
     */
    public function destroy(Review $review)
    {
        // Check authorization
        if ($review->user_id !== Auth::guard('user')->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $review->delete();

        return response()->json(['message' => 'Review berhasil dihapus!']);
    }

    /**
     * Get reviews by product ID (published only)
     */
    public function getProductReviews(Product $product)
    {
        $reviews = $product->publishedReviews()
            ->with('user')
            ->latest()
            ->paginate(10);

        return response()->json($reviews);
    }
}
