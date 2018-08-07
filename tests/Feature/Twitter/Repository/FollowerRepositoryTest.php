<?php

namespace Tests\Feature;

use WhosThere\Twitter\Entity\FollowerCollection;
use WhosThere\Twitter\FollowerRepositoryInterface;
use WhosThere\Twitter\Repository\FollowerRepository;
use WhosThere\Twitter\TwitterClientInterface;

class FollowerRepositoryTest extends FeatureTestCase
{
    /**
     * @test
     */
    public function it_instantiates()
    {
        $followerRepository = new FollowerRepository(\Mockery::mock(TwitterClientInterface::class));

        $this->assertInstanceOf(FollowerRepositoryInterface::class, $followerRepository);
    }

    /**
     * @test
     */
    public function findAllByUserId_returns_empty_follower_collection_when_no_followers_for_user_id()
    {
        // Arrange
        $userId = rand(1, 10000);
        $mockedClient = \Mockery::mock(TwitterClientInterface::class);
        $mockedClient->shouldReceive('getFollowersList')->andReturn([]);
        $followerRepository = new FollowerRepository($mockedClient);

        // Act
        $result = $followerRepository->findAllByUserId($userId);

        // Assert
        $this->assertInstanceOf(FollowerCollection::class, $result);
        $this->assertEmpty($result);
    }

    /**
     * @test
     */
    public function findAllByUserId_returns_1_follower_when_1_follower_for_user_id()
    {
        // Arrange
        $userId = rand(1, 10000);
        $mockedClient = \Mockery::mock(TwitterClientInterface::class);
        $mockedClient->shouldReceive('getFollowersList')->andReturn([
            ['id' => rand(1, 1000000)],
        ]);

        $followerRepository = new FollowerRepository($mockedClient);

        // Act
        $result = $followerRepository->findAllByUserId($userId);

        // Assert
        $this->assertInstanceOf(FollowerCollection::class, $result);
        $this->assertEquals(1, count($result));
    }

    /**
     * @test
     */
    public function findAllByUserId_returns_4_followers_when_4_followers_for_user_id()
    {
        // Arrange
        $userId = rand(1, 10000);
        $mockedClient = \Mockery::mock(TwitterClientInterface::class);
        $mockedClient->shouldReceive('getFollowersList')->andReturn([
            ['id' => rand(1, 1000000)],
            ['id' => rand(1, 1000000)],
            ['id' => rand(1, 1000000)],
            ['id' => rand(1, 1000000)],
        ]);

        $followerRepository = new FollowerRepository($mockedClient);

        // Act
        $result = $followerRepository->findAllByUserId($userId);

        // Assert
        $this->assertInstanceOf(FollowerCollection::class, $result);
        $this->assertEquals(4, count($result));
    }
}
