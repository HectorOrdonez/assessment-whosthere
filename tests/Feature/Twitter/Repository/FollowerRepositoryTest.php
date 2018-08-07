<?php

namespace Tests\Feature;

use WhosThere\Twitter\FollowerRepositoryInterface;
use WhosThere\Twitter\Repository\FollowerRepository;

class FollowerRepositoryTest extends FeatureTestCase
{
    /**
     * @test
     */
    public function it_instantiates()
    {
        $followerRepository = new FollowerRepository();

        $this->assertInstanceOf(FollowerRepositoryInterface::class, $followerRepository);
    }
}
