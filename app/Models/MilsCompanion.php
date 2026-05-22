<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MilsCompanion extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'content',
        'hero_image',
        'gallery',
        'features',
        'android_url',
        'ios_url',
        'website_url',
        'keywords',
        'is_featured',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'gallery' => 'array',
        'features' => 'array',
        'keywords' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];
}