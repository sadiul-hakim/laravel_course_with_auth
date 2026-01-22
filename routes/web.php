<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Route::redirect("/", "/dashboard");

// auth is a built-in middleware for authentication. It protects the protected routes. It redirects to GET /login router if not authenticated/
// Laravel looks to GET /login route if user is not authenticated and redirects.
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name("profile")->middleware('throttle:rate_limit');
    Route::view('/dashboard', 'dashboard');
    Route::post("/save-profile", [ProfileController::class, "save"]);
    Route::post("/logout", function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect("/");
    })->name("logout");
});

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::view('/login', 'login')->name('login');
    Route::view('/register', 'register')->name('register');
});

require_once __DIR__ . "/db_routes.php";


if (app()->environment('local')) { // only in dev
    DB::listen(function ($query) {
        // Format query with bindings
        $sql = str_replace(
            array_map(fn($k) => '?', $query->bindings),
            array_map(fn($b) => "'{$b}'", $query->bindings),
            $query->sql
        );

        Log::channel("sql_queries")->info("[SQL] {$sql} ({$query->time} ms)");
    });

    DB::whenQueryingForLongerThan(500, function ($connection, QueryExecuted $event) {
        Log::channel("sql_queries")->warning("[SQL] Long Running Query :: {$event->sql} took {$connection->totalQueryDuration()} ms");
    });
}


// Route::fallback(function () {
//     return view('not_found');
// });
