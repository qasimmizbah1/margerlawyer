<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Webinar extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'short_description',
        'speaker_name',
        'event_date',
        'event_time',
        'event_timezone',
        'button_text',
        'button_url',
        'featured_image',
        'is_active',
    ];
}