<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'excerpt', 'image', 'status', 'published_at'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
