<?php

namespace Justijndepover\LocalizedRoutes\Macros;

use Illuminate\Support\Facades\Route;
use Justijndepover\LocalizedRoutes\Middleware\RedirectLocale;

class LocalizedRoutesMacro
{
    public static function register()
    {
        Route::macro('localized', function ($callback) {
            $locales = config('localized-routes.locales');

            foreach ($locales as $abbreviation => $locale) {
                Route::name("$abbreviation.")
                    ->prefix($abbreviation)
                    ->middleware(RedirectLocale::class)
                    ->group($callback);
            }

            // register a fallback
            Route::fallback(function () {
                abort(404);
            })->middleware(RedirectLocale::class);
        });
    }
}
