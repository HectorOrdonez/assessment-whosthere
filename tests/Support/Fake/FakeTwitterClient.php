<?php

namespace Tests\Support\Fake;

use WhosThere\Twitter\TwitterClientInterface;

class FakeTwitterClient  implements TwitterClientInterface
{
    public function placeholder($string)
    {
        // TODO: Implement placeholder() method.
    }

    public function getFollowersList($userId)
    {
        // TODO: Implement getFollowersList() method.
    }

    public function getRetweetsList($statusId)
    {
        // TODO: Implement getRetweetsList() method.
    }

}
