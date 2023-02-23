<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Throwable;

final class BitfinexV1Client implements BitfinexClientInterface
{
    private const BASE_API_URL = 'https://api.bitfinex.com/v1';
    private const TICKER_URL = 'pubticker';

    public function getLastPrice(string $symbol): float
    {
        try {
            /** @var Response $response */
            $response = Http::withUrlParameters([
                'endpoint' => sprintf('%s/%s', self::BASE_API_URL, self::TICKER_URL),
                'symbol' => $symbol,
            ])->get('{+endpoint}/{symbol}')->throwIf(fn(Response $response) => !$response->ok());

        } catch (Throwable $exception) {
            throw new RuntimeException(
                'Cannot request the last price from Bitfinex.',
                $exception->getCode(),
                $exception
            );
        }

        return $response['last_price'];
    }
}
