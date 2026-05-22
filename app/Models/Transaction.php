<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'amount',
        'transaction_type',
        'short_description',
        'button_text',
        'button_url',
        'featured_image',
        'is_active',
    ];
}