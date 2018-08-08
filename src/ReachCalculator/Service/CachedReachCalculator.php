<?php

namespace WhosThere\ReachCalculator\Service;

use Illuminate\Contracts\Cache\Repository as Cache;
use WhosThere\ReachCalculator\ReachCalculatorServiceInterface;

class CachedReachCalculator implements ReachCalculatorServiceInterface
{
    private $cache;
    private $calculator;

    /**
     * CachedReachCalculator constructor.
     * @param ReachCalculator $calculator
     * @param Cache $cache
     */
    public function __construct(ReachCalculator $calculator, Cache $cache)
    {
        $this->cache = $cache;
        $this->calculator = $calculator;
    }

    /**
     * @inheritdoc
     */
    public function calculate($url)
    {
        return $this->cache->remember("calculations:{$url}", 120, function () use ($url) {
            return $this->calculator->calculate($url);
        });
    }
}
