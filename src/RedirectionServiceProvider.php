<?php

namespace Dannymcc\Redirection;

use Illuminate\Support\ServiceProvider;

class RedirectionServiceProvider extends ServiceProvider{

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/redirection.php' => config_path('redirection.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../database/migrations' => $this->app->databasePath() . '/migrations'
        ], 'migrations');

        // Register redirect middleware.
        $kernel = $this->app['Illuminate\Contracts\Http\Kernel'];
        $kernel->pushMiddleware('Dannymcc\Redirection\Middleware\RedirectIfExists');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/redirect.php', 'redirect'
        );
    }
}