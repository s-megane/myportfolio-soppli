<?php
namespace App\Services;
use App\Event;
use App\Game;
use App\User;
use Carbon\Carbon;
use DB;

class GradesService {
    
    public function getData()
    {
        $year = Carbon::now()->year;
        $user = \Auth::user(); 
        $getEvents = $user->attendances()->whereYear('attendances.created_at' , $year)->where('attendances.status' , 1)->orderBy('attendances.id','desc')->get();
        
        return $getEvents;
    }
    
    public function getgrades ($gameId,$Col)  //その試合の自分の成績データ
    {
        return \Auth::user()->usergames()->where("game_id" ,$gameId)->value($Col);
    }
    
    public function getgame($id)
    {
        return  Game::findorfail($id);
    }
    public  function getauthuser()
    {
        return  $user = \Auth::user();
    }
    
    public function getuser($id)
    {
        return User::findorfail($id);
    }
    
    
    
   
}