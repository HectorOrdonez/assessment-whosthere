<?php

namespace WhosThere\ReachCalculator;

use WhosThere\Twitter\Exception\TwitterClientException;

interface ReachCalculatorServiceInterface
{
    /**
     * Requires the url of a tweet. Will gather its retweeters and their followers. Then returns the total
     * @param string $url
     * @return int
     * @throws TwitterClientException
     */
    public function calculate($url);
}
