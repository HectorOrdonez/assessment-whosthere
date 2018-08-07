<?php

namespace Tests\Feature;

use WhosThere\Twitter\RetweetRepositoryInterface;
use WhosThere\Twitter\Repository\RetweetRepository;

class RetweetRepositoryTest extends FeatureTestCase
{
    /**
     * @test
     */
    public function it_instantiates()
    {
        $retweetRepository = new RetweetRepository();

        $this->assertInstanceOf(RetweetRepositoryInterface::class, $retweetRepository);
    }
}
