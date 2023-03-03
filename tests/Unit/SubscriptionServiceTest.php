<?php

namespace Tests\Unit;

use App\Http\Services\SubscriptionService;
use App\Models\Subscription;
use App\Repository\SubscriptionRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SubscriptionServiceTest extends TestCase
{
    private SubscriptionRepository&MockObject $subscriptionRepository;
    private SubscriptionService $subscriptionService;

    public function setUp(): void
    {
        parent::setUp();

        $this->subscriptionRepository = $this->createMock(SubscriptionRepository::class);
        $this->subscriptionService = new SubscriptionService($this->subscriptionRepository);
    }

    public function testCreateSubscription(): void
    {
        $validatedData = [
            'email' => 'johndoe@gmail.com',
            'if_price_is_above' => 1234.56,
        ];

        $this->subscriptionRepository
            ->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(Subscription::class));

        $result = $this->subscriptionService->createSubscription($validatedData);

        $this->assertSame($validatedData['email'], $result->email);
        $this->assertSame($validatedData['if_price_is_above'], $result->if_price_is_above);
    }
}
