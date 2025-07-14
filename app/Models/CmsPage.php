<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CmsPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'feature_image',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_active'
    ];
     protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean',

    ];
    
}
