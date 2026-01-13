<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    //
    public function save(Request $request)
    {
        if ($request->hasFile("file")) {
            $request->file("file")->store("uploads", "public");
        }
        // $request->session()->flash("message", "Profile Updated");
        // return redirect("/profile")->withInput();
        // return redirect("/profile")->withInput(
        //$request -> except('password')
        //);
        // back();
        // back() -> withInput;
        return redirect()->route("profile")->with("message", "Profile Updated");
    }
}
