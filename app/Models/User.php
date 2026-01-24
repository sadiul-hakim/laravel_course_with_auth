<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function passport()
    {
        return $this->hasOne(Passport::class, "user_id", "id");
        // class,foreign_key,local_key
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function latestPost()
    {
        // return $this->hasOne(Post::class)->latestOfMany();
        // return $this->hasOne(Post::class)->ofMany('id', 'max');
        // return $this->hasOne(Post::class)->oldestOfMany();
        // return $this->hasOne(Post::class)->ofMany([
        //     'likes' => 'max',
        //     'id' => 'max'
        // ]);
        return $this->hasOne(Post::class)->ofMany([
            'likes' => 'max',
            'id' => 'max'
        ], function (Builder $builder) {
            $builder->where('created_at', "<", now()->subYears(1));
        });
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function invoice()
    {
        return $this->hasOneThrough(
            Invoice::class,
            Order::class,
            'user_id', // Optional, foreign key on order table
            'order_id', // Optional, foreign key on invoice table
            'id', // Optional, local key on order table
            'id' // Optional, local key on invoice table
        );
    }

    public function invoices()
    {
        return $this->hasManyThrough(
            Invoice::class,
            Order::class
        );
    }

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'role_user', //Optional, table name
            'user_id', //Optional
            'role_id' //Optional
        );
        // -> withPivot("id") // By default created_at, updated_at, user_id, role_id are available, if the pivot table contains extra info we need to mention while making relation

    }

    public function image()
    {
        return $this->morphOne(Image::class, "imageable");
    }
}
