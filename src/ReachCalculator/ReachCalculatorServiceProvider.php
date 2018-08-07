<?php

namespace WhosThere\TwitterClient;

use Illuminate\Support\ServiceProvider;
use WhosThere\ReachCalculator\Service\ReachCalculator;
use WhosThere\ReachCalculator\ReachCalculatorServiceInterface;

class ReachCalculatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ReachCalculatorServiceInterface::class, function () {
            return new ReachCalculator();
        });
    }
}
