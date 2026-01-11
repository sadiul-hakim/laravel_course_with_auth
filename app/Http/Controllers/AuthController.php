<?php

namespace App\Http\Controllers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        // TODO: Make service class
        $validated = $request -> validate([
            'email'=>'required:max:55|email',
            'password'=>'required|min:6|max:16'
        ]);

        if(!Auth::attempt($validated)){
            throw new AuthenticationException();
        }

        $request -> session() -> regenerate();
        return redirect("/");
    }
}
