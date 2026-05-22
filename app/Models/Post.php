<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'short_description',
        'keywords',
        'is_published',
        'published_at',
        'feature_image',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];
   public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post', 'post_id', 'category_id');
    }

      public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
     protected $with = ['author'];

    // Or use appends if you want specific author data
    protected $appends = ['author_name'];

    public function getAuthorNameAttribute()
    {
        return $this->author ? $this->author->name : null;
    }

    public function setKeywordsAttribute($value)
    {
    $this->attributes['keywords'] = is_array($value) ? implode(',', $value) : $value;
    }
    public function getKeywordsAttribute($value)
    {
    return $value ? explode(',', $value) : [];
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
}