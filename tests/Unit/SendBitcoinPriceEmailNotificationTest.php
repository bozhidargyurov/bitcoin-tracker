<?php

namespace Tests\Unit;

use App\Events\BitcoinTrendCreated;
use App\Listeners\SendBitcoinPriceEmailNotification;
use App\Mail\BitcoinPriceRaisedEmail;
use App\Models\Subscription;
use App\Repository\SubscriptionRepository;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class SendBitcoinPriceEmailNotificationTest extends TestCase
{
    private SubscriptionRepository&MockObject $subscriptionRepository;
    private SendBitcoinPriceEmailNotification $sendBitcoinPriceEmailNotification;

    public function setUp(): void
    {
        parent::setUp();

        $this->createApplication();
        Mail::fake();

        $this->subscriptionRepository = $this->createMock(SubscriptionRepository::class);

        $this->sendBitcoinPriceEmailNotification = new SendBitcoinPriceEmailNotification($this->subscriptionRepository);
    }

    public function testHandle(): void
    {
        $price = 1234.56;
        $bitcoinTrendCreated = new BitcoinTrendCreated($price);

        $subscription1 = new Subscription();
        $subscription1->email = 'johndoe@gmail.com';
        $subscription1->if_price_is_above = 1200;

        $subscription2 = new Subscription();
        $subscription2->email = 'johndoe2@gmail.com';
        $subscription2->if_price_is_above = 1230;

        $subscriptions = [
            $subscription1,
            $subscription2,
        ];

        $this->subscriptionRepository
            ->expects($this->once())
            ->method('findAllBelowPrice')
            ->with($price)
            ->willReturn($subscriptions);

        $this->sendBitcoinPriceEmailNotification->handle($bitcoinTrendCreated);

        Mail::assertSent(BitcoinPriceRaisedEmail::class, 2);
    }
}
