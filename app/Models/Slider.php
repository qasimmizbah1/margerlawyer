<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'bgimage',
        'image',
        'title',
        'subtitle',
        'council_title',
        'ma_council',
        'details-heading',
        'content',
        'button_text',
        'button_url',
        'order',
        'is_active',
    ];

    protected $casts = [
        'ma_council' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}