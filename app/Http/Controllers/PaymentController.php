<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;

class PaymentController extends Controller
{
    public function __construct(
        private PaymentService $paymentService
    ) {}

    public function pay()
    {
        $this->paymentService->pay();
    }
}
