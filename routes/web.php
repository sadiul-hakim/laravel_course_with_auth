<?php

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

Route::redirect("/","/name");

Route::get('/name/{name?}', function (string $name=null) {
    return view('welcome',['name'=>$name]);
}) -> where(['name'=>'[a-zA-Z]+']);



Route::middleware("auth") -> group(function(){
    Route::get("/profile",function(){
        return view("profile");
    }) -> middleware("throttle:rate_limit");
});

Route::view("/login","login") -> name("login");
Route::view("/register","register") -> name("register");



Route::get("/test-rate-limiter",function(){
    $executed = RateLimiter::attempt("send-message",5,function(){
        return "Sending Mail";
    });

    dump($executed);
    if(!$executed){
        return "Too Many Messages";
    }
});


// Singed Route, user does not need to be logged in to access this. Suppose Unsubscribe from mail etc.
Route::get("/unsubscribe",function(){
    // echo url() -> temporarySignedRoute("unsubscribe",now()-> addMinutes(30),['user'=>1]);
    // http://127.0.0.1:8000/unsubscribe?expires=1768106993&user=1&signature=be9eaf7d26188ddde7af4a2ea69c885e48970be4e2f9243a38467fa5e9efe00d
})->name("unsubscribe") -> middleware("signed");


Route::fallback(function(){
    return view('not_found');
});
