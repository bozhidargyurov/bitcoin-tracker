<?php

namespace App\Providers;

use App\Services\BitfinexClientInterface;
use App\Services\BitfinexV1Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->alias(BitfinexV1Client::class, BitfinexClientInterface::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
