<?php

use App\Jobs\FileWritterJob;
use App\Jobs\GenerateInvoiceJob;
use App\Jobs\InventoryReservationJob;
use App\Jobs\UpdateOrderStatusJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;

Route::get("/queues", function () {
    FileWritterJob::dispatch();
    // ->afterCommit();
    dump("Welcome");
});

Route::get("/chained-jobs", function () {
    $order = (object) ['item' => 'HP Elitebook 840 g3'];

    Bus::chain([
        new InventoryReservationJob($order),
        new GenerateInvoiceJob($order),
        new UpdateOrderStatusJob($order)
    ])
        ->dispatch();
});
