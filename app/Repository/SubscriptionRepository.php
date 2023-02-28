<?php

namespace App\Repository;

use App\Models\Subscription;
use Illuminate\Support\Facades\DB;

class SubscriptionRepository
{
    /**
     * @return array<int, Subscription>
     */
    public function findAllBelowPrice(float $price): array
    {
        return DB::table('subscriptions')
            ->where('if_price_is_above', '<', $price)
            ->get()
            ->toArray();
    }

    public function save(Subscription $subscription): void
    {
        $subscription->save();
    }
}
