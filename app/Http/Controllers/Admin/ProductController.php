<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.product.product', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('admin.product.tambah_menu');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'price' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'image_2' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'image_3' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'status' => ['required', 'in:Tersedia,Habis'],
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        if ($request->hasFile('image_2')) {
            $imagePath = $request->file('image_2')->store('products', 'public');
            $validated['image_2'] = $imagePath;
        }

        if ($request->hasFile('image_3')) {
            $imagePath = $request->file('image_3')->store('products', 'public');
            $validated['image_3'] = $imagePath;
        }

        $product = Product::create($validated);

        \App\Models\ActivityLog::log('product', 'Menu baru ditambahkan', "Produk baru {$product->name} berhasil ditambahkan ke kategori {$product->category}.");

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'price' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'image_2' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'image_3' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'status' => ['required', 'in:Tersedia,Habis'],
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                \Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        if ($request->hasFile('image_2')) {
            if ($product->image_2) {
                \Storage::disk('public')->delete($product->image_2);
            }
            $imagePath = $request->file('image_2')->store('products', 'public');
            $validated['image_2'] = $imagePath;
        }

        if ($request->hasFile('image_3')) {
            if ($product->image_3) {
                \Storage::disk('public')->delete($product->image_3);
            }
            $imagePath = $request->file('image_3')->store('products', 'public');
            $validated['image_3'] = $imagePath;
        }

        $product->update($validated);

        \App\Models\ActivityLog::log('product', 'Katalog menu diperbarui', "Admin memperbarui informasi pada produk {$product->name}.");

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Delete image if exists
        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }

        $productName = $product->name;
        $product->delete();

        \App\Models\ActivityLog::log('product', 'Menu dihapus', "Admin menghapus produk {$productName} dari katalog.");

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
