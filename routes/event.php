<?php

use App\Events\CommentAddedEvent;
use App\Events\ExampleEvent;
use App\Events\PostAddedEvent;
use App\Order;
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
