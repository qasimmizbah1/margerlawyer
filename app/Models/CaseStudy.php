<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    protected $fillable = [
    'title',
    'slug',
    'client_name',
    'industry',
    'short_description',
    'content',
    'feature_image',
    'gallery',
    'keywords',
    'is_published',
    'published_at',
];
protected $casts = [
    'gallery' => 'array',
    'keywords' => 'array',
    'is_published' => 'boolean',
    'published_at' => 'datetime',
];
}
