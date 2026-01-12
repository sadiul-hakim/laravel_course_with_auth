<?php

declare(strict_types=1);

namespace App\Services;

class PayoneerPaymentService implements PaymentService
{
    public function pay(): void
    {
        echo 'Paying using Payoneer';
    }
}
