<?php

declare(strict_types=1);

namespace App\Services;

interface PaymentService
{
    public function pay(): void;
}
