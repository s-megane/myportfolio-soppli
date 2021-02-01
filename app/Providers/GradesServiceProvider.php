<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GradesService;
class GradesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
        'GradesService', // キー名
        'App\Services\GradesService' // クラス名
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
