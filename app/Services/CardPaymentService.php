<?php

declare(strict_types=1);

namespace App\Services;

class CardPaymentService implements PaymentService
{
    public function pay(): void
    {
        echo 'Paying using Card';
    }
}
