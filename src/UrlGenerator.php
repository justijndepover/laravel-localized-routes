<?php

namespace Justijndepover\LocalizedRoutes;

use Illuminate\Routing\UrlGenerator as RoutingUrlGenerator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

class UrlGenerator extends RoutingUrlGenerator
{
    /**
     * Resolve the URL to a named route or a localized version of it.
     *
     * @param string $name
     * @param array $parameters
     * @param bool $absolute
     * @param string|null $locale
     *
     * @return string
     */
    public function route($name, $parameters = [], $absolute = true, $locale = null)
    {
        // resolve from base if locale is empty
        if (Route::has($name) && $locale === null) {
            return parent::route($name, $parameters, $absolute);
        }

        // Cache the current locale so we can change it
        // to automatically resolve any translatable
        // route parameters such as slugs.
        $currentLocale = App::getLocale();

        // Use the specified or current locale
        // as a prefix for the route name.
        $locale = $locale ?: $currentLocale;

        // Normalize the route name by removing any locale prefix.
        // We will prepend the applicable locale manually.
        $baseName = $name; // $this->stripLocaleFromRouteName($name);

        // If the route has a name (not just the locale prefix)
        // add the requested locale prefix.
        $newName = $baseName ? "{$locale}.{$baseName}" : '';

        // If the new localized name does not exist, but the unprefixed route name does,
        // someone might be calling "route($name, [], true, $locale)" on a non localized route.
        // In that case, resolve the unprefixed route name.
        if (Route::has($baseName) && ! Route::has($newName)) {
            $newName = $baseName;
        }

        // Update the current locale if needed.
        if ($locale !== $currentLocale) {
            App::setLocale($locale);
        }

        $url = parent::route($newName, $parameters, $absolute);

        // Restore the current locale if needed.
        if ($locale !== $currentLocale) {
            App::setLocale($currentLocale);
        }

        return $url;
    }
}
