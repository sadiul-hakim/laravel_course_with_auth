<?php

namespace App\Listeners;

use App\Events\ExampleEvent;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ExampleListener implements ShouldQueue
// ,ShouldDispatchAfterCommit
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ExampleEvent $event): void
    {
        Log::channel("daily")->info("Listener is visited");
        dump($event->order->price);
    }
}
