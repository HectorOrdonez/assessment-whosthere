<?php

namespace Tests\Feature;

use WhosThere\ReachCalculator\Service\ReachCalculator;
use WhosThere\ReachCalculator\ReachCalculatorServiceInterface;
use WhosThere\TwitterClient\TwitterClientInterface;

class ReachCalculatorServiceTest extends FeatureTestCase
{
    /**
     * @test
     */
    public function it_instantiates()
    {
        $service = new ReachCalculator($this->getMockedClient());

        $this->assertInstanceOf(ReachCalculatorServiceInterface::class, $service);
    }

    /**
     * @test
     */
    public function it_returns_0_when_no_retweets()
    {
        // Arrange
        $client = $this->getMockedClient();
        $client->shouldReceive('placeholder')->andReturn([]);
        $url = $this->faker()->url;
        $service = new ReachCalculator($client);

        // Act
        $result = $service->calculate($url);

        // Assert
        $client->shouldHaveReceived('placeholder')->with($url);
        $this->assertEquals(0, $result);
    }

    /**
     * @test
     */
    public function it_returns_1_when_1_retweeter_without_followers()
    {
        // Arrange
        $client = $this->getMockedClient();
        $client->shouldReceive('placeholder')->andReturn(['something']);

        $url = $this->faker()->url;
        $service = new ReachCalculator($client);

        // Act
        $result = $service->calculate($url);

        // Assert
        $client->shouldHaveReceived('placeholder')->with($url);
        $this->assertEquals(1, $result);
    }


    /**
     * @test
     */
    public function it_returns_3_when_1_retweeter_with_2_followers()
    {
        // Arrange
        $client = $this->getMockedClient();
        $client->shouldReceive('placeholder')->andReturn(['something']);

        $url = $this->faker()->url;
        $service = new ReachCalculator($client);

        // Act
        $result = $service->calculate($url);

        // Assert
        $client->shouldHaveReceived('placeholder')->with($url);
        $this->assertEquals(3, $result);
    }

    /**
     * @return \Mockery\MockInterface|TwitterClientInterface
     */
    private function getMockedClient()
    {
        return \Mockery::mock(TwitterClientInterface::class);
    }
}
