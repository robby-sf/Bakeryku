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
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $userId = Auth::id();

        // Check if user already has a pending review for this product
        $existingReview = Review::where('user_id', $userId)
            ->where('product_id', $validated['product_id'])
            ->where('status', 'pending')
            ->first();

        if ($existingReview) {
            return response()->json(['message' => 'Anda sudah memiliki review yang pending untuk produk ini'], 422);
        }

        $validated['user_id'] = $userId;
        $review = Review::create($validated);

        // Create notification for admin
        $product = Product::find($validated['product_id']);
        $adminId = User::where('role', 'admin')->value('id') ?: 1;

        Notification::create([
            'user_id' => $adminId,
            'title' => 'Review Baru',
            'message' => "User telah menambahkan review untuk produk {$product->name}",
            'type' => 'review',
            'link' => route('admin.reviews.index', ['status' => 'pending']),
            'related_review_id' => $review->id,
        ]);

        return redirect()->back()->with('success', 'Review berhasil dikirim dan menunggu persetujuan admin');
    }

    /**
     * Update the specified review.
     */
    public function update(Request $request, Review $review)
    {
        // Check authorization
        if ($review->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Only pending reviews can be updated
        if ($review->status !== 'pending') {
            return response()->json(['message' => 'Hanya review yang pending dapat diubah'], 422);
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
        if ($review->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Only pending reviews can be deleted
        if ($review->status !== 'pending') {
            return response()->json(['message' => 'Hanya review yang pending dapat dihapus'], 422);
        }

        $review->delete();

        return response()->json(['message' => 'Review berhasil dihapus!']);
    }

    /**
     * Get reviews by product ID (approved only)
     */
    public function getProductReviews(Product $product)
    {
        $reviews = $product->approvedReviews()
            ->with('user')
            ->latest('reviewed_at')
            ->paginate(10);

        return response()->json($reviews);
    }
}
