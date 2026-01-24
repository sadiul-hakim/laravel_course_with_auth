<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    use HasFactory;

    protected $fillable = ["passport_number", "issuing_country", "expiry_date"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
