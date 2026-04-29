<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Show the specified product details
     */
    public function show(Product $product)
    {
        $reviews = $product->approvedReviews()->latest()->paginate(10);
        $averageRating = $product->averageRating();
        $reviewCount = $product->reviewCount();
        $isFavorited = false;

        if (auth()->guard('user')->check()) {
            $isFavorited = auth()->guard('user')->user()->favorites()->where('product_id', $product->id)->exists();
        }

        return view('Menu.menu_view', compact('product', 'reviews', 'averageRating', 'reviewCount', 'isFavorited'));
    }
}
