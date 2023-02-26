<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubscriptionRequest;
use App\Http\Services\SubscriptionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SubscriptionApiController extends Controller
{
    private SubscriptionService $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * Create a new subscription.
     */
    public function store(CreateSubscriptionRequest $createSubscriptionRequest): JsonResponse
    {
        $subscription = $this->subscriptionService->createSubscription(
            $createSubscriptionRequest->validated()
        );

        return response()->json($subscription, Response::HTTP_CREATED);
    }
}
