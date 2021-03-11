<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // ←追加
use Illuminate\Support\Facades\Schema;
use App\Game;
use App\Event;
use Carbon\Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\GradesService'); // 追記
        $this->app->bind('App\Services\UserService');
        $this->app->bind('App\Services\EventService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \URL::forceScheme('https');
        Schema::defaultStringLength(191);
        
        \Gate::define("admin" , function($users){
            return ($users->role === 1);    
        });
        
        \Gate::define("cap" , function($users){
            return ($users->role <= 2);    
        });
        
        \Gate::define('user', function ($user) {
            return ($user->role > 1 && $user->role <= 3);
        });
        
        View::composer('*', function($view) {
            $now = Carbon::now()->year;
            //今年のイベントを取得
            $getyear = Event::whereYear('eventdate' , $now)->orderBy('created_at' , 'desc')->get();
            //去年のイベントを取得
            $getbefore = Event::whereYear('eventdate' , $now-1)->orderBy('created_at' , 'desc')->get();
            //おととしのイベントを取得
            $getago = Event::whereYear('eventdate' , $now-2)->orderBy('created_at' , 'desc')->get();
            
            $view->with([
                'now' => $now,
                'getyear' => $getyear,
                'getbefore' => $getbefore,
                'getago' => $getago,
                ]);
        });
        
    
    }
}
