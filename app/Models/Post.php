<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["title", "content"];
    protected $casts = [
        'metadata' => 'array'
    ];

    public function user()
    {
        //belongsTo() means “this model holds the foreign key” — not how many records exist on the other side.
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, "imageable");
        // return $this->morphMany(Image::class, "imageable");
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, "taggable", "taggables");
    }
}
