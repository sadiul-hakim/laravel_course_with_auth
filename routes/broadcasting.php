<?php

use App\Events\ForPusherEvent;
use App\Notifications\BroadcastNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function () {
    Route::get("/broadcasting-client", function () {
        return view("broadcasting.client");
    });
    Route::get("/broadcast", function () {
        $order = (object) ['id' => 1, 'price' => 123];
        ForPusherEvent::dispatch($order);
        // broadcast(new ForPusherEvent($order))->toOthers();
    });

    Route::get("broadcast-notification", function (Request $request) {
        $invoice = (object) ['status' => 'paid'];
        Notification::send($request->user(), new BroadcastNotification($invoice));
    });

    Route::get("broadcast-notification-client", function () {
        return view("broadcasting.broadcast-notification-client");
    });
});

Route::get("/client-events-first-client", function () {
    return view("broadcasting.client-events-first-client");
});

Route::get("/client-events-second-client", function () {
    return view("broadcasting.client-events-second-client");
});
