<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \URL::forceScheme('https');
        
        \Gate::define("admin" , function($users){
            return ($users->role == 1);    
        });
        
        \Gate::define('user', function ($user) {
            return ($user->role > 1 && $user->role <= 3);
        });
    }
}
