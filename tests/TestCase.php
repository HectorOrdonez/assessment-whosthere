<?php

namespace Tests;

use Faker\Generator;
use Faker\Provider\nl_NL\Address as DutchAddress;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

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
