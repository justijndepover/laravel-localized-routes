<?php

namespace Justijndepover\LocalizedRoutes\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Justijndepover\LocalizedRoutes\LocalizedRoutesServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            LocalizedRoutesServiceProvider::class,
        ];
    }
}
