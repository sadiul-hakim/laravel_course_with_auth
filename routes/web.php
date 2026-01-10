<?php

use Illuminate\Support\Facades\Route;

Route::get('/{name?}', function (string $name=null) {
    return view('welcome',['name'=>$name]);
}) -> where(['name'=>'[a-zA-Z]+']);

Route::fallback(function(){
    return view('not_found');
});
