<?php

namespace App\Http\Controllers;

use App\Http\Services\BitcoinTrendService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BitcoinTrendsApiController extends Controller
{
    private BitcoinTrendService $bitcoinTrendService;

    public function __construct(BitcoinTrendService $bitcoinTrendService)
    {
        $this->bitcoinTrendService = $bitcoinTrendService;
    }

    /**
     * List bitcoin trends.
     */
    public function index(): JsonResponse
    {
        $trends = $this->bitcoinTrendService->listTrends();

        return response()->json($trends, Response::HTTP_OK);
    }
}
