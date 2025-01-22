<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use App\Http\Middleware\AdminMiddleware;
// use App\Http\Middleware\UserMiddleware;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->app['router']->aliasMiddleware('admin', \App\Http\Middleware\AdminMiddleware::class);
        $this->app['router']->aliasMiddleware('user', \App\Http\Middleware\UserMiddleware::class);
    }

}
