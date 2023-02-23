<?php

namespace App\Services;

interface BitfinexClientInterface
{
    public function getLastPrice(string $symbol): float;
}
