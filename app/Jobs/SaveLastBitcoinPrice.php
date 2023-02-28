<?php

namespace App\Jobs;

use App\Events\BitcoinTrendCreated;
use App\Models\BitcoinTrend;
use App\Repository\BitcoinTrendRepository;
use App\Services\BitfinexClientInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveLastBitcoinPrice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private const BITFINEX_SYMBOL = 'BTCUSD';

    private BitcoinTrendRepository $bitcoinTrendRepository;

    public function __construct(BitcoinTrendRepository $bitcoinTrendRepository)
    {
        $this->bitcoinTrendRepository = $bitcoinTrendRepository;
    }

    /**
     * Execute the job.
     */
    public function handle(BitfinexClientInterface $bitfinexClient, Dispatcher $dispatcher): void
    {
        $lastPrice = $bitfinexClient->getLastPrice(self::BITFINEX_SYMBOL);

        $bitcoinTrend = new BitcoinTrend();
        $bitcoinTrend->price = $lastPrice;

        $this->bitcoinTrendRepository->save($bitcoinTrend);

        $dispatcher->dispatch(new BitcoinTrendCreated($lastPrice));
    }
}
