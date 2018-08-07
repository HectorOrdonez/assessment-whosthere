<?php

namespace Tests\Feature;

use WhosThere\Twitter\TwitterClientInterface;
use WhosThere\Twitter\Entity\RetweetCollection;
use WhosThere\Twitter\RetweetRepositoryInterface;
use WhosThere\Twitter\Repository\RetweetRepository;

class RetweetRepositoryTest extends FeatureTestCase
{
    /**
     * @test
     */
    public function it_instantiates()
    {
        $retweetRepository = new RetweetRepository(\Mockery::mock(TwitterClientInterface::class));

        $this->assertInstanceOf(RetweetRepositoryInterface::class, $retweetRepository);
    }

    /**
     * @test
     */
    public function findAllByStatusId_returns_empty_retweet_collection_when_status_has_no_retweets()
    {
        // Arrange
        $statusId = rand(1, 10000000);
        $mockedClient = \Mockery::mock(TwitterClientInterface::class);
        $mockedClient->shouldReceive('getRetweetsList')->andReturn([]);
        $retweetRepository = new RetweetRepository($mockedClient);

        // Act
        $result = $retweetRepository->findAllByStatusId($statusId);

        // Assert
        $this->assertInstanceOf(RetweetCollection::class, $result);
        $this->assertCount(0, $result);
    }

    /**
     * @test
     */
    public function findAllByStatusId_returns_1_retweet_when_status_was_retweeted_once()
    {
        // Arrange
        $userId = rand(1, 1000);
        $statusId = rand(1, 10000000);
        $mockedClient = \Mockery::mock(TwitterClientInterface::class);
        $mockedClient->shouldReceive('getRetweetsList')->andReturn([
            ['user' => ['id' => $userId]]
        ]);

        $retweetRepository = new RetweetRepository($mockedClient);

        // Act
        $result = $retweetRepository->findAllByStatusId($statusId);

        // Assert
        $this->assertInstanceOf(RetweetCollection::class, $result);
        $this->assertCount(1, $result);
        $this->assertEquals($userId, $result[0]->getUserId());
    }
}
