<?php

namespace WhosThere\TwitterClient;

use Illuminate\Support\ServiceProvider;
use WhosThere\TwitterClient\Client\TwitterClient;

class TwitterClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TwitterClientInterface::class, function () {
            return new TwitterClient();
        });
    }
}
