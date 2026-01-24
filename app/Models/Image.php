<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory;

    public function imageable()
    {
        return $this->morphTo();
        // return $this->morphTo(__FUNCTION__, 'imageable_type', 'imageable_id');
    }
}
