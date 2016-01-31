<?php

namespace MatthC\Laradmin;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class LaradminServiceProvider extends ServiceProvider
{

    public function boot()
    {
        App::register(\MatthC\Privileges\PrivilegesServiceProvider::class);
        App::register(\HieuLe\Active\ActiveServiceProvider::class);
        App::bind('Active', function()
        {
            return new \HieuLe\Active\Facades\Active;
        });
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'laradmin');

        $this->publishes([
            __DIR__.'/../config/laradmin.php' => config_path('laradmin.php'),
        ]);

        $this->publishes([
            __DIR__.'/../../public' => public_path('vendor/laradmin'),
        ], 'public');

        if (! $this->app->routesAreCached()) {
            require __DIR__.'/../routes.php';
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }
}