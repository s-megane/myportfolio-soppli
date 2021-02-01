<?php
namespace App\Services;
use App\Event;
use App\Game;
use App\User;
use Carbon\Carbon;
use DB;

class UserService {
    
    public function getranking($col)
    {
        $cnt = 1;
        $gameCount = Game::count();
        $rank = 1;
        $now = Carbon::now()->year;
        $users = User::all();
        foreach($users as $user){
            if($gameCount > 0)  //試合数が0じゃなければ
            {
                if($gameCount <= $user->totalSum($now , '' , '.at_bat'))
                {
                    $data[] = ['id'=>$user->id ,'name'=>$user->name ,  
                    'hr'=>$user->totalSum($now , '' , '.hr') ,'rbi'=>$user->totalSum($now , '' , '.rbi') ,
                    'atbat'=>$user->totalSum($now , '' , '.at_bat') ,'ave'=>$user->totalaverage($now,'','.hits','.at_bat'),'rank'=>$rank.'位'];
                }
            }else{
                $data = [];
            }
        }
        //dd($data);
        $collection = collect($data)->sortByDesc($col)->take(3);
        
          
                // if($key[$col] = ($key-1)[$col]){
                //     $rank = $rank;
                //     echo $coll['name'];
                //     //$coll->replace(['rank' => $rank]);
                // }else{
                //     $rank = $rank++;
                // }
            //$collection->replace(['rank' => $rank]);    
           //dd($rank); 
            
        
          
        
        return $collection;
    }
    
    public function getserch($id,$opponent,$year)
    {
        $user = User::findOrFail($id);
        $query = $user->usergames();
        if(empty($opponent) && !empty($year))
        {
            $query->whereYear('users_games.created_at' , 'like' , '%' . $year . '%');
        } 
        if(!empty($opponent) && empty($year))
        {
            
            $query->where('opponent' , 'like' , '%' . $opponent . '%');
        }
        if(!empty($opponent) && !empty($year))
        {
            $query->whereYear('users_games.created_at' , $year);
            $query->where('opponent' , 'like' , '%' . $opponent . '%');
        }
        $data = $query->get();
        return $data ;
    }
    
}
