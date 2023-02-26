<?php

namespace App\Listeners;

use App\Events\BitcoinTrendCreated;
use App\Mail\BitcoinPriceRaisedEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendBitcoinPriceEmailNotification
{
    public function handle(BitcoinTrendCreated $event): void
    {
        $subscriptions = DB::table('subscriptions')
            ->where('if_price_is_above', '<', $event->getPrice())
            ->get();

        foreach ($subscriptions as $subscription) {
            Mail::to($subscription->email)->send(
                new BitcoinPriceRaisedEmail($subscription->if_price_is_above, $event->getPrice())
            );
        }
    }
}
