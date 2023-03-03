<?php

namespace Tests\Unit;

use App\Events\BitcoinTrendCreated;
use App\Jobs\SaveLastBitcoinPrice;
use App\Models\BitcoinTrend;
use App\Repository\BitcoinTrendRepository;
use App\Services\BitfinexClientInterface;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class SaveLastBitcoinPriceTest extends TestCase
{
    private BitfinexClientInterface&MockObject $bitfinexClient;
    private BitcoinTrendRepository&MockObject $bitcoinTrendRepository;
    private SaveLastBitcoinPrice $saveLastBitcoinPrice;

    public function setUp(): void
    {
        parent::setUp();

        Event::fake();

        $this->bitfinexClient = $this->createMock(BitfinexClientInterface::class);
        $this->bitcoinTrendRepository = $this->createMock(BitcoinTrendRepository::class);

        $this->saveLastBitcoinPrice = new SaveLastBitcoinPrice(
            $this->bitfinexClient,
            $this->bitcoinTrendRepository
        );
    }

    public function testHandle(): void
    {
        $lastPrice = 1245.56;

        $this->bitfinexClient
            ->expects($this->once())
            ->method('getLastPrice')
            ->with($this->isType('string'))
            ->willReturn($lastPrice);

        $this->bitcoinTrendRepository
            ->expects($this->once())
            ->method('save')
            ->with($this::callback(function (BitcoinTrend $bitcoinTrend) use ($lastPrice): bool {
                $this->assertSame($lastPrice, $bitcoinTrend->price);

                return true;
            }));

        $this->saveLastBitcoinPrice->handle();

        Event::assertDispatched(BitcoinTrendCreated::class, function (BitcoinTrendCreated $bitcoinTrendCreated) use ($lastPrice) {
            $this->assertSame($lastPrice, $bitcoinTrendCreated->getPrice());

            return true;
        });
    }
}
