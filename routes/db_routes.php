<?php

use App\Models\Image;
use App\Models\Passport;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function () {
    Route::get("/users", function () {

        // CRUD
        // dump(DB::select("select * from users where id = ?", [1]));
        // dump(DB::select("select * from users where id = :id", [':id' => 1]));
        // dump(DB::select("select count(*) as users from users"));
        // dump(DB::scalar("select count(*) as users from users"));
        // dump(DB::insert("insert into users(name,email,password) values (?,?,?)", [
        //     "Hassan",
        //     "hassan@gmail.com",
        //     bcrypt("hakim@123")
        // ]));
        // dump(
        //     DB::update("update users set name = ? where id = ?", [
        //         "AS Hassan",
        //         3
        //     ])
        // );
        // dump(
        //     DB::delete("delete from users where id = ?", [3])
        // );

        // Statement
        // dump(DB::statement("truncate table teachers"));

        // Transaction
        // DB::transaction(function () {
        //     DB::update('update users set name = ? where id = ?', ['Riaz', 2]);
        //     throw new Exception();
        //     DB::update('update users set name = ? where id = ?', ['Hakim', 1]);
        // }, 5);

        // Print generated query
        // dump(DB::pretend(function () {
        //     User::where("name2", 'Hakim')
        //         ->orderBy('id')
        //         ->take(10)
        //         ->get();
        // }));
        dump(DB::select("select * from users where id = ? and sleep(1)", [1]));
    });

    Route::get("/users-latest-post", function () {
        dump(User::find(1)->latestPost->likes);
    });

    Route::get("/users-invoices", function () {
        dump(User::find(1)->invoices);
    });

    Route::get("/users-roles", function () {
        dump(User::find(1)->roles);
    });

    Route::get("/images", function () {
        dump(Image::find(1));
        dump(User::find(1)->image);
    });

    Route::get("/remove-relation", function () {
        $passport = Passport::find(1);
        $passport->user()->dissociate();
    });
    Route::post("/save-video", function () {
        $user = User::find(1);
        $passport = new Passport([
            'expiry_date' => now()->addYear(),
            'issuing_country' => 'Bangladesh',
            'passport_number' => 'DF123445'
        ]);

        $passport->user()->associate($user);
        $passport->save();
    });
    Route::get("/save-role", function () {
        $user = User::find(1);
        $user->roles()->attach(4); // role id
        // $user->roles()->sync([2,4]); // role id
        // $user->roles()->detach(4);
        $post = Post::find(1);
    });
    Route::post("/save-video", function () {
        $video = Video::create(
            [
                'title' => 'test',
                'url' => 'test'
            ]
        );

        $tag = new Tag(['name' => 'test']);
        $video->tags()->save($tag);
        $video->tags()->saveMany([
            new Tag(['name' => 'test1']),
            new Tag(['name' => 'test2'])
        ]);
        $video->tags()->create(['name' => 'test']);
    });

    Route::get("delete", function () {
        // User::find(4)->delete();
        $post = Post::find(2);
        $metadata = $post->metadata;
        unset($metadata['author']);
        $post->metadata = $metadata;
        $post->save();
    });
    Route::get("update", function () {
        // User::where('email', 'block.esmeralda@example.org')
        //     ->update(
        //         [
        //             'name' => 'new name'
        //         ]
        //     );
        // User::updateOrCreate(
        //     ['email' => 'sadiulhakim@gmail.com'],
        //     [
        //         'name' => 'Sadi',
        //         'email' => 'sadiulhakim@gmail.com',
        //         'password' => encrypt('hakim@123')
        //     ]
        // );

        $post = Post::find(1);
        $metadata = $post->metadata;
        $metadata['author'] = 'new author';
        $post->metadata = $metadata;
        $post->save();
    });
});
