<?php

namespace App\Providers;

use App\Http\Controllers\PaymentController;
use App\Services\PayoneerPaymentService;
use App\View\Composers\TestComposer;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as IlluminateView;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentController::class, PayoneerPaymentService::class);
        //     $this->app->when(PaymentController::class)
        //         ->needs(PaymentService::class)
        //         ->give(PayoneerPaymentService::class);
    }

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

        View::composer(['dashboard', 'profile'], TestComposer::class);

        // or
        // View::composer(['dashboard', 'profile'], function (IlluminateView $view) {
        //     $view->with('text_key', 'text_value');
        // });
        // View::share("key","value"); // for all views
    }
}
