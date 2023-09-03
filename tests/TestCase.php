<?php

namespace Insyht\LarvelousShop\Tests;

use Insyht\LarvelousShop\Providers\ShopServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            ShopServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {

    }
}
