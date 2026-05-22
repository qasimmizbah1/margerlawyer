<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_image',
        'client_name',
        'client_designation',
        'content',
        'rating',
        'linkdin',
        'is_active',
    ];
}
