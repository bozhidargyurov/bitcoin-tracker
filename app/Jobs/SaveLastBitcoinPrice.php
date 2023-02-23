<?php

namespace App\Jobs;

use App\Models\BitcoinTrend;
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

    /**
     * Execute the job.
     */
    public function handle(BitfinexClientInterface $bitfinexClient): void
    {
        $lastPrice = $bitfinexClient->getLastPrice(self::BITFINEX_SYMBOL);

        $bitcoinTrend = new BitcoinTrend();
        $bitcoinTrend->price = $lastPrice;
        $bitcoinTrend->save();
    }
}
