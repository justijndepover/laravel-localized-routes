<?php

namespace Justijndepover\LocalizedRoutes\Tests;

class LocalizedRoutesTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        config()->set('localized-routes', [
            'enable_localized_routes' => true,
            'locales' => [
                'en' => 'English',
                'nl' => 'Nederlands',
            ],
            'auto_detect_locales' => true,
            'auto_redirect_to_localized_route' => true,
        ]);

    }

    /** @test */
    public function it_assets_true()
    {
        // code
    }
}
