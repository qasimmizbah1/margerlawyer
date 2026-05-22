<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'feature_image',
        'domain_name',
        'is_active',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];
    protected $casts = [
        'description' => 'array',
        'is_active' => 'boolean',

    ];
}
