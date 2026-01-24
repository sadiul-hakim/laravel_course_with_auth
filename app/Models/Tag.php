<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    public function posts()
    {
        // One tag suppose id 1 can belong to multiple Posts or Videos or any other model `taggable_type`
        return $this->morphToMany(Post::class, "taggable", "taggables");
    }

    public function videos()
    {
        return $this->morphToMany(Video::class, "taggable", "taggables");
    }
}
