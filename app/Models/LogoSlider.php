<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogoSlider extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logos',
    ];

    protected $casts = [
        'logos' => 'array',
    ];
}
