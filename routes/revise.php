<?php

use App\Http\Controllers\TestController;
use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

Route::get("/test-log", function () {
    Log::channel("daily")->warning("Warning :: test url is visited");
    return "test";
});

Route::get("/error", function () {
    // throw new HttpException(500, 'Server error');
    abort(500);
});

// Route::get("/get-user-by-id/{userId}", function (int $userId) {
//     try {
//         return User::findOrFail($userId);
//     } catch (Throwable $ex) {
//         Log::channel("daily")->error("User $userId is not found.");
//         return ['message' => 'User is not found'];
//     }
// });

Route::get("/get-user-by-id/{userId}", [TestController::class, "index"]);
Route::get("/put-in-cache", function () {
    // Cache::put("key", "value", 600);
    dump(Cache::get("key"));
});

Route::get("/cache-remember", function () {
    $value = Cache::remember('users.all', 60, function () {
        return User::all();
    });
    // if (Cache::has('users.all')) {
    //     return Cache::get('users.all');
    // }

    // $result = User::all();      // function executed
    // Cache::put('users.all', $result, 60);

    // return $result;

    dump($value);

    // Cache::rememberForever('settings', function () {
    //     return Setting::all();
    // });
    // Never expires

    // You MUST call Cache::forget('settings') manually
});

Route::get("/remove-from-cache/{key}", function (string $key) {
    // Cache::put("key", "value", 600);
    Cache::forget($key);
});

Route::get("/flush-cache", function () {
    // Cache::put("key", "value", 600);
    Cache::flush();
});

Route::get("/send-mail", function () {
    Mail::to("sadiulhakim@gmail.com")->send(new TestMail("Test", "Test"));
});
Route::get("/process", function () {
    $process = Process::start("pwd");
    // $process = Process::run("pwd");
    while ($process->running()) {
        dump("Running........");
    }

    $result = $process->wait();
    // $result = $process->output();
    dump($result);
});

Route::get("/play-with-storage", function () {
    // Storage::disk("public")->append("folder1/example.txt", "Hi");
    // return Storage::disk("public")->download("folder1/example.txt");
    dump(Storage::disk("public")->mimeType("folder1/example.txt"));
    dump(Storage::disk("public")->size("folder1/example.txt"));
    dump(asset("folder1/example.txt"));
    return Storage::disk("public")->get("folder1/example.txt");
});

Schedule::call(function () {
    Storage::disk("public")->append("folder1/example.txt", "Hi");
})->everyMinute();

Route::middleware("cache.headers:public;max_age=2628000;etag")->group(function () {
    Route::get("http-cache", function () {
        return "http-cache";
    });
});



// emergency, alert, critical, error, warning, notice, info, debug
