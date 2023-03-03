<?php

namespace Tests\Unit;

use App\Http\Services\BitcoinTrendService;
use App\Models\BitcoinTrend;
use App\Repository\BitcoinTrendRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BitcoinTrendServiceTest extends TestCase
{
    private BitcoinTrendRepository&MockObject $bitcoinTrendRepository;
    private BitcoinTrendService $bitcoinTrendService;

    public function setUp(): void
    {
        parent::setUp();

        $this->bitcoinTrendRepository = $this->createMock(BitcoinTrendRepository::class);
        $this->bitcoinTrendService = new BitcoinTrendService($this->bitcoinTrendRepository);
    }

    public function testListTrends(): void
    {
        $expected = [
            $this->createMock(BitcoinTrend::class),
        ];

        $this->bitcoinTrendRepository
            ->expects($this->once())
            ->method('getAll')
            ->willReturn($expected);

        $result = $this->bitcoinTrendService->listTrends();

        $this->assertSame($expected, $result);
    }
}
