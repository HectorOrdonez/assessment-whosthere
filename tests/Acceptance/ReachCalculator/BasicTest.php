<?php

namespace Tests\Acceptance\ReachCalculator;

use Tests\Acceptance\AcceptanceTestCase;
use Tests\Support\Fake\FakeTwitterClient;
use WhosThere\TwitterClient\TwitterClientInterface;

class BasicTest extends AcceptanceTestCase
{
    /**
     * @test
     * @expectedException \Symfony\Component\Console\Exception\RuntimeException
     * @expectedExceptionMessage Not enough arguments (missing: "url")
     */
    public function it_requires_url()
    {
        $this->artisan('reach:calculate');
    }

    /**
     * @test
     */
    public function it_reaches_twitter_client()
    {
        // Arrange
        $fakeClient = \Mockery::spy(new FakeTwitterClient());

        $this->app->instance(TwitterClientInterface::class, $fakeClient);

            // Act
        $this->artisan('reach:calculate', ['url' => $this->faker()->url]);

        // Assert
        $fakeClient->shouldHaveReceived('placeholder');
    }
}
