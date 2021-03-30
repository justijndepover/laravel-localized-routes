<?php

namespace Justijndepover\LocalizedRoutes;

use Illuminate\Support\ServiceProvider;
use Justijndepover\LocalizedRoutes\Macros\LocalizedRoutesMacro;
use Justijndepover\LocalizedRoutes\UrlGenerator;

class LocalizedRoutesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfig();
        $this->registerUrlGenerator();
    }

    public function boot()
    {
        $this->registerPublishableFiles();
        $this->registerMacros();
        $this->determineAppLocale();
    }

    private function mergeConfig()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/localized-routes.php', 'localized-routes');
    }

    private function registerPublishableFiles()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/localized-routes.php' => config_path('localized-routes.php'),
            ], 'laravel-localized-routes-config');
        }
    }

    private function registerMacros()
    {
        LocalizedRoutesMacro::register();
    }

    private function determineAppLocale()
    {
        if (! config('localized-routes.auto_detect_locales')) {
            return;
        }

        $locale = app()->request->segment(1);

        if (array_key_exists($locale, config('localized-routes.locales'))) {
            app()->setLocale($locale);
        }

        if (app()->request->hasHeader('locale') && array_key_exists(app()->request->header('locale'), config('localized-routes.locales'))) {
            app()->setLocale(app()->request->header('locale'));
        }
    }

    protected function registerUrlGenerator()
    {
        $this->app->singleton('url', function ($app) {
            $routes = $app['router']->getRoutes();

            // The URL generator needs the route collection that exists on the router.
            // Keep in mind this is an object, so we're passing by references here
            // and all the registered routes will be available to the generator.
            $app->instance('routes', $routes);

            return new UrlGenerator(
                $routes,
                $app->rebinding(
                    'request',
                    $this->requestRebinder()
                ),
                $app['config']['app.asset_url']
            );
        });
    }

    /**
     * Get the URL generator request rebinder.
     *
     * @return \Closure
     */
    protected function requestRebinder()
    {
        return function ($app, $request) {
            $app['url']->setRequest($request);
        };
    }
}
