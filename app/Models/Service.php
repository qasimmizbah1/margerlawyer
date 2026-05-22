<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Service extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'feature_image',
        'sections',
        'short_description',
        'keywords',
    ];

    protected $casts = [
        'sections' => 'array'
    ];
    public function setKeywordsAttribute($value)
    {
    $this->attributes['keywords'] = is_array($value) ? implode(',', $value) : $value;
    }
    public function getKeywordsAttribute($value)
    {
    return $value ? explode(',', $value) : [];
    }
     public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug',
                'onUpdate' => true, // Update slug when title changes
            ]
        ];
    }
}