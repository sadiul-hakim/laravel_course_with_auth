<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SQLMonitoringController extends Controller
{
    //
    public function monitor()
    {
        DB::listen(function ($query) {
            dump($query->sql);
            dump($query->bindings);
            dump($query->time);
        });
    }
}
