<?php
namespace App\Http\ViewComposers;
 
use Illuminate\Contracts\View\View;
use App\Game;
 
class LayoutComposer 
{
 
    protected $game;
 
    public function __construct($game)
    {
        
        $this->game = $game;
        
    }
 
    public function compose(View $view)
    {
        $game = "ttt";
        $view->with("game" , $game);
    }
    
 
}