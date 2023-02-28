<?php

namespace App\Http\Services;

use App\Models\Subscription;
use App\Repository\SubscriptionRepository;

class SubscriptionService
{
    private SubscriptionRepository $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function createSubscription(array $validatedData): Subscription
    {
        $subscription = new Subscription();
        $subscription->email = $validatedData['email'];
        $subscription->if_price_is_above = $validatedData['if_price_is_above'];

        $this->subscriptionRepository->save($subscription);

        return $subscription;
    }
}
