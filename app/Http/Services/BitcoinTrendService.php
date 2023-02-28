<?php

namespace App\Http\Services;

use App\Models\BitcoinTrend;
use App\Repository\BitcoinTrendRepository;

class BitcoinTrendService
{
    private BitcoinTrendRepository $bitcoinTrendRepository;

    public function __construct(BitcoinTrendRepository $bitcoinTrendRepository)
    {
        $this->bitcoinTrendRepository = $bitcoinTrendRepository;
    }

    /**
     * @return array<int, BitcoinTrend>
     */
    public function listTrends(): array
    {
        return $this->bitcoinTrendRepository->getAll();
    }
}
