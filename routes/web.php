<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvokableController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SQLMonitoringController;
use App\Http\Controllers\TestController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

// Route::redirect('/', '/name');

// Route::get('/name/{name?}', function (?string $name = null) {
//     return view('welcome', ['name' => $name]);
// })->where(['name' => '[a-zA-Z]+']);

Route::get('/', function (Request $request) {
    return view('welcome');
});

Route::get("/response/{user?}", function (Request $request, User $user) {
    // return ['user'=>'adam'];
    // return $user;
    // return response()->json(['name' => 'hakim']);
    // return response("Hi")->cookie('name', 'Hakim');
    // return response("Hi")->withoutCookie('name');
    // return response("Hi", 200)->header('Content-Type', 'text/plain');

    // return redirect()->away('https://www.google.com');
    // return redirect()->route("profile");
    // return redirect()->action([PaymentController::class, "pay"]);
    return redirect()->action([PaymentController::class, "pay"]);
})->name('response');

Route::get("/session", function (Request $request) {
    $request->session()->put("cartItem", 100);
    dump($request->session());
    dump($request->session()->get("cartItem"));
    dump($request->session()->pull("cartItem", 0));
    // $request->session()->forget("cartItem");
    dump($request->session());
    $request->session()->flush();
    dump($request->session()->has("cartItem"));
    dump($request->session()->exists("cartItem"));
    dump($request->session());
});
Route::get("/download", function () {
    // dump(public_path("storage/uploads/H09l4XpFeXD7UaXvrvXloYu7FcyULZAooQhGjxo1.png"));
    return response()->download(
        public_path("storage/uploads/H09l4XpFeXD7UaXvrvXloYu7FcyULZAooQhGjxo1.png"),
        "image.png",
        [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="image.png"',
        ]
    );
});

// Route::get("/user/{key:name}",function(User $user){ // implicit parameter

// });

// auth is a built-in middleware for authentication. It protects the protected routes. It redirects to GET /login router if not authenticated/
// Laravel looks to GET /login route if user is not authenticated and redirects.
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name("profile")->middleware('throttle:rate_limit');
    Route::view('/dashboard', 'dashboard');
    Route::get('/pay', [PaymentController::class, 'pay']);
    Route::post("/save-profile", [ProfileController::class, "save"]);
});

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::view('/login', 'login')->name('login');
    Route::view('/register', 'register')->name('register');
});

Route::get('/hash/{text}', function (string $text) {
    $encrypted = Crypt::encryptString($text);
    dump($encrypted);
    dump(Crypt::decryptString($encrypted));
    dump(bcrypt($text));

    $hashed = Hash::make($text);
    dump($hashed);
    dump(Hash::check($text, $hashed));
});

Route::get('/test-rate-limiter', function () {
    $executed = RateLimiter::attempt('send-message', 5, function () {
        return 'Sending Mail';
    });

    dump($executed);
    if (! $executed) {
        return 'Too Many Messages';
    }
});

// Singed Route, user does not need to be logged in to access this. Suppose Unsubscribe from mail etc.
Route::get('/unsubscribe', function () {
    // echo url() -> temporarySignedRoute("unsubscribe",now()-> addMinutes(30),['user'=>1]);
    // http://127.0.0.1:8000/unsubscribe?expires=1768106993&user=1&signature=be9eaf7d26188ddde7af4a2ea69c885e48970be4e2f9243a38467fa5e9efe00d
})->name('unsubscribe')->middleware('signed');

// Route::resource('test', TestController::class); // use resource controller for most CRUD operations, it's clean
// Route::resource('test.common', TestController::class);// Nested /test/{test}/common/{common}
Route::resource('test.common', TestController::class)->only(['index', 'show']);
Route::apiResource('test', TestController::class); // without create, edit routes
Route::resource('test', TestController::class)->except(['create', 'store', 'update', 'destroy']);

// single action controller
Route::get('/invoke', InvokableController::class); // No need to provide method name. __invoke method would be called.

Route::get('/monitor-sql', [SQLMonitoringController::class, 'monitor']);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

if (app()->environment('local')) { // only in dev
    DB::listen(function ($query) {
        // Format query with bindings
        $sql = str_replace(
            array_map(fn($k) => '?', $query->bindings),
            array_map(fn($b) => "'{$b}'", $query->bindings),
            $query->sql
        );

        Log::info("[SQL] {$sql} ({$query->time} ms)");
    });
}

Route::fallback(function () {
    return view('not_found');
});
