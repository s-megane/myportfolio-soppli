<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class eventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'EventService', // キー名
            'App\Services\EventService' // クラス名
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
