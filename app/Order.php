<?php

namespace App;

class Order
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $product,
        public int $price
    ) {
        //
    }
}
