<?php

use App\Models\User;
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
});
