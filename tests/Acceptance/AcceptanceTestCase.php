<?php

namespace Tests\Acceptance;

use Tests\TestCase;
use Faker\Generator;
use Faker\Provider\nl_NL\Address as DutchAddress;

abstract class AcceptanceTestCase extends TestCase
{
    /**
     * @return Generator
     */
    protected function faker()
    {
        $generator = $this->app->make(Generator::class);
        $generator->addProvider(DutchAddress::class);

        return $generator;
    }

}
