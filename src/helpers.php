<?php

if (! function_exists('route')) {
    function route(String $name, $parameters = [], Bool $absolute = true, String $locale = null): string
    {
        return app('url')->route($name, $parameters, $absolute, $locale);
    }
}

if (! function_exists('switchLanguage')) {
    function switchLanguage($locale)
    {
        $segments = request()->segments();
        if (in_array($segments[0], array_keys(config('localized-routes.locales')))) {
            $segments[0] = $locale;
        }

        return '/' . implode('/', $segments);
    }
}
