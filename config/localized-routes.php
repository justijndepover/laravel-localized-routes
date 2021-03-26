<?php

return [

    /**
     * This global setting can enable / disable the entire localization package.
     */
    'enable_localized_routes' => true,

    /**
     * This list contains all the available locales.
     * Simply add your own locale and thats it!
     */
    'locales' => [
        'en' => 'English',
        'nl' => 'Nederlands',
    ],

    /**
     * Automatically detect locales
     *
     * With this setting enabled, you can automatically detect locales.
     * The middleware to do so will check the request for a "locale" header
     *
     * useful for api's, where you don't want the locale prefix,
     * but still want to set the application locale
     */
    'auto_detect_locales' => true,

    /**
     * Automatically redirect requests if the localized version exists
     *
     * With this setting enabled, your requests will automatically redirect
     * to their localized counterpart.
     *
     * For example: /home => /en/home
     */
    'auto_redirect_to_localized_route' => true,

];
