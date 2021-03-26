# Laravel Localized Routes

[![Latest Version on Packagist](https://img.shields.io/packagist/v/justijndepover/laravel-localized-routes.svg?style=flat-square)](https://packagist.org/packages/justijndepover/laravel-localized-routes)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/justijndepover/laravel-localized-routes.svg?style=flat-square)](https://packagist.org/packages/justijndepover/laravel-localized-routes)

Setup your Laravel application with localized routes

## Caution

This application is still in development and could implement breaking changes. Please use at your own risk.

## Installation

You can install the package with composer

```sh
composer require justijndepover/laravel-localized-routes
```

After installation you should publish your configuration file

```sh
php artisan vendor:publish --tag="laravel-localized-routes-config"
```

## configuration

This is the config file

```php
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
```

## Usage

To make your routes multi lingual add this in your `web.php`:
```php
Route::localized(function () {
    // Every route in here is localized
});
```

and thats it!

## Related repositories
This package is a simplified version of: [codezero-be/laravel-localized-routes](https://github.com/codezero-be/laravel-localized-routes)

If you want a more robust solution with more options, check out their version.

## Security

If you find any security related issues, please open an issue or contact me directly at [justijndepover@gmail.com](justijndepover@gmail.com).

## Contribution

If you wish to make any changes or improvements to the package, feel free to make a pull request.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
