<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title_ar', 'title_en', 'subtitle_ar', 'subtitle_en', 'image_url',
        'button_text_ar', 'button_text_en', 'button_url', 'sort_order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];
}
