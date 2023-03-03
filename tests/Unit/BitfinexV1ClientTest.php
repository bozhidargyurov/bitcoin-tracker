<?php

namespace Tests\Unit;

use App\Services\BitfinexV1Client;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class BitfinexV1ClientTest extends TestCase
{
    private const LAST_PRICE_SYMBOL = 'BTCUSD';

    private BitfinexV1Client $bitfinexV1Client;

    public function setUp(): void
    {
        parent::setUp();

        $this->createApplication();

        $this->bitfinexV1Client = new BitfinexV1Client();
    }

    public function testGetLastPrice(): void
    {
        $url = sprintf(
            '%s/%s/%s',
            BitfinexV1Client::BASE_API_URL,
            BitfinexV1Client::TICKER_URL,
            self::LAST_PRICE_SYMBOL
        );

        $expectedPrice = 1234.5;
        Http::fake([
            $url => Http::response([
                'last_price' => $expectedPrice,
            ])
        ]);

        $result = $this->bitfinexV1Client->getLastPrice(self::LAST_PRICE_SYMBOL);
        $this->assertSame($expectedPrice, $result);
    }
}
