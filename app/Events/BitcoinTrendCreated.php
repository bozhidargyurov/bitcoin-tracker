<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class BitcoinTrendCreated
{
    use Dispatchable;

    private float $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
