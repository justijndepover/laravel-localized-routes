<?php

namespace Justijndepover\LocalizedRoutes\Macros;

use Illuminate\Support\Facades\Route;
use Justijndepover\LocalizedRoutes\Middleware\RedirectLocale;

class LocalizedRoutesMacro
{
    public static function register()
    {
        Route::macro('localized', function ($callback) {
            if (! config('localized-routes.enable_localized_routes')) {
                $callback();

                return;
            }

            $locales = config('localized-routes.locales');
            $currentLocale = app()->getLocale();

            foreach ($locales as $abbreviation => $locale) {
                app()->setLocale($abbreviation);

                Route::name("$abbreviation.")
                    ->prefix($abbreviation)
                    ->middleware(RedirectLocale::class)
                    ->group($callback);
            }

            app()->setLocale($currentLocale);

            // register a fallback
            Route::fallback(function () {
                abort(404);
            })->middleware(RedirectLocale::class);
        });
    }
}
