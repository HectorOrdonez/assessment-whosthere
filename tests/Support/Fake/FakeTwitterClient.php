<?php

namespace Tests\Support\Fake;

use WhosThere\Twitter\TwitterClientInterface;

class FakeTwitterClient  implements TwitterClientInterface
{

    public function placeholder($string)
    {
        return [];
    }
}
