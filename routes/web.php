<?php

use Illuminate\Support\Facades\Route;

Route::redirect("/","/name");

Route::get('/name/{name?}', function (string $name=null) {
    return view('welcome',['name'=>$name]);
}) -> where(['name'=>'[a-zA-Z]+']);

Route::fallback(function(){
    return view('not_found');
});

Route::middleware("auth") -> group(function(){
    Route::get("/profile",function(){
        return view("profile");
    }) -> middleware("throttle:rate_limit");
});

Route::view("/login","login") -> name("login");
Route::view("/register","register") -> name("register");
