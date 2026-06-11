<?php

namespace App\Models;

use App\Models\Favorite;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'category',
        'price',
        'description',
        'image',
        'image_2',
        'image_3',
        'status',
    ];

    protected $casts = [
        'price' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all reviews for this product
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get only published reviews for this product
     */
    public function publishedReviews(): HasMany
    {
        return $this->reviews()->published();
    }

    /**
     * Get the average rating of this product (from published reviews)
     */
    public function averageRating(): float
    {
        return $this->publishedReviews()->avg('rating') ?? 0;
    }

    /**
     * Get the published review count
     */
    public function reviewCount(): int
    {
        return $this->publishedReviews()->count();
    }

    /**
     * Get the gallery images for this product.
     */
    public function getGalleryImagesAttribute()
    {
        return collect([$this->image, $this->image_2, $this->image_3])->filter()->values();
    }

    /**
     * Get favorites for this product.
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Get orders for this product.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
