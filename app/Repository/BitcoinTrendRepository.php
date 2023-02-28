<?php

namespace App\Repository;

use App\Models\BitcoinTrend;

class BitcoinTrendRepository
{
    /**
     * @return array<int, BitcoinTrend>
     */
    public function getAll(): array
    {
        return BitcoinTrend::all()->toArray();
    }

    public function save(BitcoinTrend $bitcoinTrend): void
    {
        $bitcoinTrend->save();
    }
}
