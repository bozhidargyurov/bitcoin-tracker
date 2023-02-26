<?php

namespace App\Http\Services;

use App\Models\BitcoinTrend;

class BitcoinTrendService
{
    /**
     * @return array<BitcoinTrend>
     */
    public function listTrends(): array
    {
        return BitcoinTrend::all()->all();
    }
}
