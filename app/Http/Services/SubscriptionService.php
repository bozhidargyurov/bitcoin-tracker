<?php

namespace App\Http\Services;

use App\Models\Subscription;

class SubscriptionService
{
    public function createSubscription(array $validatedData): Subscription
    {
        $subscription = new Subscription();
        $subscription->email = $validatedData['email'];
        $subscription->if_price_is_above = $validatedData['if_price_is_above'];
        $subscription->save();

        return $subscription;
    }
}
