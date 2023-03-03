<?php

namespace App\Jobs;

use App\Events\BitcoinTrendCreated;
use App\Models\BitcoinTrend;
use App\Repository\BitcoinTrendRepository;
use App\Services\BitfinexClientInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveLastBitcoinPrice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private const BITFINEX_SYMBOL = 'BTCUSD';

    public function __construct(
        private readonly BitfinexClientInterface $bitfinexClient,
        private readonly BitcoinTrendRepository  $bitcoinTrendRepository
    )
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $lastPrice = $this->bitfinexClient->getLastPrice(self::BITFINEX_SYMBOL);

        $bitcoinTrend = new BitcoinTrend();
        $bitcoinTrend->price = $lastPrice;

        $this->bitcoinTrendRepository->save($bitcoinTrend);

        BitcoinTrendCreated::dispatch($lastPrice);
    }
}
