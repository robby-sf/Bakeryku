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
     * Get only approved reviews for this product
     */
    public function approvedReviews(): HasMany
    {
        return $this->reviews()->approved();
    }

    /**
     * Get the average rating of this product
     */
    public function averageRating(): float
    {
        return $this->approvedReviews()->avg('rating') ?? 0;
    }

    /**
     * Get the review count
     */
    public function reviewCount(): int
    {
        return $this->approvedReviews()->count();
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

