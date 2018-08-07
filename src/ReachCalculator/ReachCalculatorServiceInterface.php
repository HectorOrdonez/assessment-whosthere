<?php

namespace WhosThere\ReachCalculator;

interface ReachCalculatorServiceInterface
{
    /**
     * Requires the url of a tweet. Will gather its retweeters and their followers. Then returns the total
     * @param string $url
     * @return int
     */
    public function calculate($url);
}
