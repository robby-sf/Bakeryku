<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->guard('user')->user()->favorites()->with('product')->latest()->paginate(12);
        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->guard('user')->user();
        /** @var Favorite|null $favorite */
        $favorite = $user->favorites()->where('product_id', $request->product_id)->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Produk dihapus dari favorit.');
        }

        $user->favorites()->create([
            'product_id' => $request->product_id,
        ]);

        return back()->with('success', 'Produk ditambahkan ke favorit.');
    }
}
