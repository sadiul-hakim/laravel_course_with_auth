<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class EntityNotFoundException extends Exception
{
    public function report()
    {
        Log::channel("daily")->error($this->getMessage());
    }

    public function render()
    {
        return response()->view("errors.entity-not-found");
    }
}
