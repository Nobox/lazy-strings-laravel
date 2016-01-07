<?php

namespace Nobox\LazyStrings;

use Illuminate\Support\ServiceProvider;
use Nobox\LazyStrings\LazyDeployCommand;
use Nobox\LazyStrings\LazyStrings;

class LazyStringsServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $views = __DIR__ . '/../views';
        $config = __DIR__ . '/../config/lazy-strings.php';
        $routes = __DIR__ . '/routes.php';
        $public = __DIR__ . '/../public';

        $this->loadViewsFrom($views, 'lazy-strings');

        $this->publishes([
            $config => config_path('lazy-strings.php'),
            $public => base_path('public/vendor/nobox/lazy-strings'),
        ]);

        include $routes;
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        // add LazyStrings class to app container
        $this->app->bind('lazy-strings', function ($app) {
            return new LazyStrings([
                'url'    => config('lazy-strings.csv-url'),
                'sheets' => config('lazy-strings.sheets'),
                'target' => base_path() . '/resources/lang',
                'backup' => storage_path() . '/' . config('lazy-strings.target-folder'),
                'nested' => config('lazy-strings.nested')
            ]);
        });

        // register `lazy:deploy` command
        $this->app->bind('command.lazy-deploy', function ($app) {
            return new LazyDeployCommand();
        });

        $this->commands('command.lazy-deploy');
    }
}
