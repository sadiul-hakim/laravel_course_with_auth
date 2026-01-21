<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

// Service Providers are executed every time a request is sent
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::pattern('id', '[0-9]+');
        RateLimiter::for('rate_limit', function (Request $request) {
            // return $request -> user() && $request -> user() -> id === 100 ? Limit::none() : Limit::perMinute(2) -> by($request -> user());
            return Limit::perMinute(5)->by($request->user() ? $request->user() : $request->ip());
        });
    }
}
