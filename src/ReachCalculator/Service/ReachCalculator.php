<?php

namespace WhosThere\ReachCalculator\Service;

use WhosThere\ReachCalculator\ReachCalculatorServiceInterface;
use WhosThere\TwitterClient\TwitterClientInterface;

class ReachCalculator implements ReachCalculatorServiceInterface
{
    /**
     * @var TwitterClientInterface
     */
    private $client;

    /**
     * ReachCalculator constructor.
     * @param TwitterClientInterface $client
     */
    public function __construct(TwitterClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritdoc
     */
    public function calculate($url)
    {
        $retweeters = $this->getRetweeters($url);

        $followers = $this->getFollowers($retweeters);

        return count($retweeters) + count($followers);
    }

    /**
     * @param $url
     * @return array
     */
    private function getRetweeters($url)
    {
        return $this->client->placeholder($url);
    }

    private function getFollowers(array $retweeters)
    {
        return [];
    }
}
