<?php

namespace Tests\Acceptance\ReachCalculator;

use Tests\Acceptance\AcceptanceTestCase;
use Tests\Support\Fake\FakeTwitterClient;
use WhosThere\Twitter\TwitterClientInterface;

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
    public function it_prints_error_when_url_is_not_a_url()
    {
        // Act
        $this->artisan('reach:calculate', ['url' => 'hi i am not a url']);

        // Assert
        $output = \Artisan::output();

        $this->assertContains('Url is not a valid url', $output);
    }

    /**
     * @test
     */
    public function it_reaches_twitter_client()
    {
        // Arrange
        $url =$this->faker()->url;
        $fakeClient = \Mockery::spy(new FakeTwitterClient());

        $this->app->instance(TwitterClientInterface::class, $fakeClient);

        // Act
        $this->artisan('reach:calculate', ['url' => $url]);

        // Assert
        $output = \Artisan::output();

        $fakeClient->shouldHaveReceived('placeholder')->with($url);
        $this->assertContains('This tweet has reached 0 people', $output);
    }
}
