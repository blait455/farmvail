<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $fillable = [
        'name', 'description', 'image'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_id');
    }
}
