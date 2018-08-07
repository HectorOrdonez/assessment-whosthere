<?php

namespace WhosThere\Twitter;

use Illuminate\Support\ServiceProvider;
use WhosThere\Twitter\Client\TwitterClient;
use WhosThere\Twitter\Repository\RetweetRepository;
use WhosThere\Twitter\Repository\FollowerRepository;

/**
 * Class TwitterServiceProvider
 *
 * This package groups a collection of bindings related to twitter
 *
 * @package WhosThere\Twitter
 */
class TwitterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TwitterClientInterface::class, function () {
            return new TwitterClient();
        });

        $this->app->singleton(FollowerRepositoryInterface::class, function () {
            return new FollowerRepository();
        });

        $this->app->singleton(RetweetRepositoryInterface::class, function () {
            return new RetweetRepository();
        });
    }
}
