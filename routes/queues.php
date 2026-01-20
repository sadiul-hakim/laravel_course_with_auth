<?php

use App\Jobs\BatchJob1;
use App\Jobs\BatchJob2;
use App\Jobs\BatchJob3;
use App\Jobs\FileWritterJob;
use App\Jobs\GenerateInvoiceJob;
use App\Jobs\InventoryReservationJob;
use App\Jobs\UpdateOrderStatusJob;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
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

Route::get("/batch-info/{batch}", function ($batch) {
    return Bus::findBatch($batch);
});
Route::get("/batch-jobs", function () {

    $batch = Bus::batch([
        new BatchJob1(),
        new BatchJob2(),
        new BatchJob3()
    ])
        ->before(function (Batch $batch) {
            Log::info($batch->progress());
        })
        ->progress(function (Batch $batch) {
            Log::info($batch->progress());
        })
        ->then(function (Batch $batch) {})
        ->catch(function (Batch $batch, Throwable $e) {
            Log::error($e->getMessage());
        })
        ->finally(function (Batch $batch) {})
        ->onConnection("database")
        ->onQueue("default")
        ->dispatch();

    return $batch->id;
});

// Use chaining for dependent tasks and batch for independent tasks.
// In Batching order does not matter but in chaining it matters.
