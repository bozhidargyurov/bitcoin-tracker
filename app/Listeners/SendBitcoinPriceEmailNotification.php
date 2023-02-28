<?php

namespace App\Listeners;

use App\Events\BitcoinTrendCreated;
use App\Mail\BitcoinPriceRaisedEmail;
use App\Repository\SubscriptionRepository;
use Illuminate\Support\Facades\Mail;

class SendBitcoinPriceEmailNotification
{
    private SubscriptionRepository $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function handle(BitcoinTrendCreated $event): void
    {
        $subscriptions = $this->subscriptionRepository->findAllBelowPrice($event->getPrice());

        foreach ($subscriptions as $subscription) {
            Mail::to($subscription->email)->send(
                new BitcoinPriceRaisedEmail($subscription->if_price_is_above, $event->getPrice())
            );
        }
    }
}
