<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'image_url',
        'price',
        'old_price',
        'badge_ar',
        'badge_en',
        'category',
        'is_featured',
        'is_new_arrival',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_new_arrival' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderByDesc('is_primary')->orderBy('sort_order');
    }

    public function getPrimaryImageUrlAttribute(): ?string
    {
        return $this->images->first()?->image_url ?: $this->image_url;
    }
}
