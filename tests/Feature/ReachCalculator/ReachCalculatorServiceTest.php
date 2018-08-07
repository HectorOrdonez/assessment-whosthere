<?php

namespace Tests\Feature;

use WhosThere\Twitter\Entity\Follower;
use WhosThere\Twitter\Entity\FollowerCollection;
use WhosThere\Twitter\Entity\Retweet;
use WhosThere\Twitter\Entity\RetweetCollection;
use WhosThere\Twitter\RetweetRepositoryInterface;
use WhosThere\Twitter\FollowerRepositoryInterface;
use WhosThere\ReachCalculator\Service\ReachCalculator;
use WhosThere\ReachCalculator\ReachCalculatorServiceInterface;

class ReachCalculatorServiceTest extends FeatureTestCase
{
    /**
     * @test
     */
    public function it_instantiates()
    {
        $service = new ReachCalculator($this->getMockedRetweetRepo(), $this->getMockedFollowerRepo());

        $this->assertInstanceOf(ReachCalculatorServiceInterface::class, $service);
    }

    /**
     * @test
     */
    public function it_returns_0_when_no_retweets()
    {
        // Arrange
        $statusId = rand(1, 1000000000000);
        $url = $this->faker()->url . '/' . $statusId;

        $retweetRepo = $this->getMockedRetweetRepo();
        $retweetRepo->shouldReceive('findAllByStatusId')->andReturn(new RetweetCollection());
        $service = new ReachCalculator($retweetRepo, $this->getMockedFollowerRepo());

        // Act
        $result = $service->calculate($url);

        // Assert
        $retweetRepo->shouldHaveReceived('findAllByStatusId')->with($statusId);
        $this->assertEquals(0, $result);
    }

    /**
     * @test
     */
    public function it_returns_1_when_1_retweeter_without_followers()
    {
        // Arrange
        $statusId = rand(1, 1000000000000);
        $url = $this->faker()->url . '/' . $statusId;
        $retweet = new Retweet(['user_id' => rand(1, 100000)]);

        $retweetRepo = $this->getMockedRetweetRepo();
        $retweetRepo->shouldReceive('findAllByStatusId')->andReturn(new RetweetCollection([$retweet]));

        $followerRepo = $this->getMockedFollowerRepo();
        $followerRepo->shouldReceive('findAllByUserId')->andReturn(new FollowerCollection());

        $service = new ReachCalculator($retweetRepo, $followerRepo);

        // Act
        $result = $service->calculate($url);

        // Assert
        $retweetRepo->shouldHaveReceived('findAllByStatusId')->with($statusId);
        $this->assertEquals(1, $result);
    }


    /**
     * @test
     */
    public function it_returns_3_when_1_retweeter_with_2_followers()
    {
        // Arrange
        $url = $this->faker()->url;

        $retweet = new Retweet(['user_id' => rand(1, 100000)]);
        $retweetRepo = $this->getMockedRetweetRepo();
        $retweetRepo->shouldReceive('findAllByStatusId')->andReturn(new RetweetCollection([$retweet]));

        $followerRepo = $this->getMockedFollowerRepo();
        $followerRepo->shouldReceive('findAllByUserId')->andReturn(new FollowerCollection([
            new Follower(),
            new Follower(),
        ]));

        $service = new ReachCalculator($retweetRepo, $followerRepo);

        // Act
        $result = $service->calculate($url);

        // Assert
        $this->assertEquals(3, $result);
    }

    private function getMockedFollowerRepo()
    {
        return \Mockery::mock(FollowerRepositoryInterface::class);
    }

    private function getMockedRetweetRepo()
    {
        return \Mockery::mock(RetweetRepositoryInterface::class);
    }
}
