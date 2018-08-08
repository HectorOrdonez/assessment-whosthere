<?php

namespace WhosThere\ReachCalculator;

use Illuminate\Support\ServiceProvider;
use WhosThere\Twitter\RetweetRepositoryInterface;
use WhosThere\Twitter\FollowerRepositoryInterface;
use WhosThere\ReachCalculator\Service\ReachCalculator;
use WhosThere\ReachCalculator\Service\CachedReachCalculator;

class ReachCalculatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ReachCalculatorServiceInterface::class, function () {
            return new CachedReachCalculator(new ReachCalculator(
                $this->app->make(RetweetRepositoryInterface::class),
                $this->app->make(FollowerRepositoryInterface::class)
            ), $this->app['cache.store']);
        });
    }
}
