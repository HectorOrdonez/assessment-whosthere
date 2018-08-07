<?php

namespace Tests\Feature;

use WhosThere\ReachCalculator\Service\ReachCalculator;
use WhosThere\ReachCalculator\ReachCalculatorServiceInterface;

class ReachCalculatorServiceTest extends FeatureTestCase
{
    /**
     * @test
     */
    public function it_instantiates()
    {
        $service = new ReachCalculator();

        $this->assertInstanceOf(ReachCalculatorServiceInterface::class, $service);
    }

    /**
     * @test
     */
    public function it_returns_0_when_no_retweets()
    {
        // Arrange
        $url = $this->faker()->url;
        $service = new ReachCalculator();

        // Act
        $result = $service->calculate($url);

        // Assert
        $this->assertEquals(0, $result);
    }
}
