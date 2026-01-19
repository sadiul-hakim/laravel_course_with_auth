<?php

namespace App\Listeners;

use App\Events\CommentAddedEvent;
use App\Events\PostAddedEvent;

class BlogSubscriber
{

    // method name matters, starts with `handle`. And Parameter type CommentAddedEvent
    public function handleCommentAddedEvent(CommentAddedEvent $event)
    {
        echo $event->comment->content . "<br/>";
    }

    public function handlePostAddedEvent(PostAddedEvent $event)
    {
        echo $event->post->content . "<br/>";
    }

    // Optional: This method is only required if we do not follow method name convention.
    public function subscribe(): array
    {
        return [
            CommentAddedEvent::class => "handleCommentAddedEvent",
            PostAddedEvent::class => "handlePostAddedEvent"
        ];
    }
}
