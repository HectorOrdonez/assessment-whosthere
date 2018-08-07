<?php

namespace Tests\Support\Fake;

use WhosThere\TwitterClient\TwitterClientInterface;

class FakeTwitterClient  implements TwitterClientInterface
{

    public function placeholder($string)
    {
        return 10;
    }
}
