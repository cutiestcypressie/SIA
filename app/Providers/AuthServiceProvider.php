<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services.
     *
     * @return void
     */
    public function boot()
    {
        // Removed Passport route registration:
        // LumenPassport::routes($this->app->router);
    }
}