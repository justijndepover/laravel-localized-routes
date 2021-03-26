<?php

namespace Justijndepover\LocalizedRoutes\Middleware;

use Closure;

class RedirectLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $request->segment(1);

        if (! array_key_exists($locale, config('localized-routes.locales'))) {
            $segments = $request->segments();
            array_unshift($segments, $request->cookie('locale', array_keys(config('localized-routes.locales'))[0]));

            return redirect(implode('/', $segments));
        }

        $response = $next($request);
        if (method_exists($response, 'cookie')) {
            return $response->cookie('locale', $locale);
        }

        return $response;
    }
}
