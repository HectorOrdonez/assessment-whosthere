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
            return new TwitterClient(
                env('TWITTER_CONSUMER_KEY'),
                env('TWITTER_CONSUMER_SECRET'),
                env('TWITTER_ACCESS_TOKEN'),
                env('TWITTER_ACCESS_TOKEN_SECRET')
            );
        });

        $this->app->singleton(FollowerRepositoryInterface::class, function () {
            return new FollowerRepository($this->app->make(TwitterClientInterface::class));
        });

        $this->app->singleton(RetweetRepositoryInterface::class, function () {
            return new RetweetRepository($this->app->make(TwitterClientInterface::class));
        });
    }
}
