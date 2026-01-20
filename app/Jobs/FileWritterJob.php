<?php

namespace App\Jobs;

use DateTime;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;

class FileWritterJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        sleep(10);
        $now = new DateTime();
        $formatted = $now->format('Y-m-d H:i:s');
        Storage::disk("public")->append("folder1/example.txt", $formatted . " From Queue");
    }
}
