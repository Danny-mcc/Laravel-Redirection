# Laravel Redirection

A package for handling redirects via a database.

## Installation

You can install the package via composer:

```bash
composer require dannymcc/laravel-redirection
```

Next add the service provider to config/app.php:

```php
// config/app.php
'providers' => [
    ...
    Dannymcc\Redirection\RedirectionServiceProvider::class,
];
```

Optional, publish the config file:

```php
php artisan vendor:publish --provider="Dannymcc\LaravelRedirection\RedirectionServiceProvider"
```

## Usage

``` php
Redirect::create([
    'from_url'      => '/from-here',
    'to_url'        => '/to-here,
    'status_code'   => 302
]);
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.