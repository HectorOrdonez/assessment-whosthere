<?php

namespace Tests\Support\Fake;

use WhosThere\Twitter\TwitterClientInterface;

class FakeTwitterClient implements TwitterClientInterface
{
    public $followers = [];
    public $retweets = [];

    public function getFollowersList($userId)
    {
        return $this->followers;
    }

    public function getRetweetsList($statusId)
    {
        return $this->retweets;
    }
}
