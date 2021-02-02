<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // 追加
use App\Game;
use App\Event;
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //View::composer('events.*', 'App\Http\ViewComposers\LayoutComposer');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    // public function boot()
    // {
        
    //         View::composers([
    //         LayoutComposer::class => [
    //           'events.index',
    //           'games.index'
    //       ]
    //   ]);
        
    // }
}
