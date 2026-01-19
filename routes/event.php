<?php

use App\Events\CommentAddedEvent;
use App\Events\ExampleEvent;
use App\Events\PostAddedEvent;
use App\Notifications\ExampleNotifcation;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

Route::get("/event", function () {

    // When we ShouldQueue the Listener, we should make a serializable class
    // $order = new class {
    //     public string $product = "Tablet";
    //     public int $price = 300;
    // };

    $order = new Order("Tablet", 300);

    // Anything passed to a queued event/listener MUST be serializable
    ExampleEvent::dispatch($order);
    return "event dispatched";
});

Route::get("/notifications", function (Request $req) {
    // $invoice = new class {
    //     public string $status = "Paid";
    // };

    $invoice = ['status' => 'Paid'];

    Notification::send($req->user(), new ExampleNotifcation($invoice));
})->middleware("auth");

Route::get("/get-notifications", function (Request $req) {
    foreach ($req->user()->notifications as $noti) {
        dump($noti['data']);
    }
})->middleware("auth");
Route::get("/subscribers", function () {

    $post = new class {
        public string $title = "post title";
        public string $content = "post content";
    };

    $comment = new class {
        public string $content = "post comment";
    };

    PostAddedEvent::dispatch($post);
    CommentAddedEvent::dispatch($comment);
});
