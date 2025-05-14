<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('localized_route')) {
    function localized_route(String $name, $parameters = [], Bool $absolute = true, String $locale = null): string
    {
        return app('url')->route($name, $parameters, $absolute, $locale);
    }
}

if (! function_exists('switchLanguage')) {
    function switchLanguage($locale)
    {
        $currentRoute = Route::currentRouteName();

        // anonymous route without locale prefix
        if (! $currentRoute) {
            return request()->url();
        }

        $parts = explode('.', $currentRoute, 2);
        $routeName = $parts[1] ?? $parts[0]; // 'home'

        // named route, but without locale prefix
        if (! in_array($parts[0], array_keys(config('localized-routes.locales')))) {
            return request()->url();
        }

        // anonymous route, but with locale prefix
        if (empty($routeName)) {
            $segments = request()->segments();
            $segments[0] = $locale;
            return '/' . implode('/', $segments);
        }

        // named route and with locale prefix
        return localized_route($routeName, Route::current()->parameters(), true, $locale);
    }
}
