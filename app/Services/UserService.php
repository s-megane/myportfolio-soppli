<?php
namespace App\Services;
use App\Event;
use App\Game;
use App\User;
use Carbon\Carbon;
use DB;

class UserService {
    
    //ユーザーの成績一覧コレクションを作成する
    public function addCollection($col)
    {
        $gameCount = Game::count();
        $rank = 1;
        $now = Carbon::now()->year;
        $users = User::all();
        $usergamesCount = DB::table('users_games')->count();
        //dd($usergamesCount);
        foreach($users as $user){
            if($usergamesCount > 0)  //users_gamesが0じゃなければ
            {
                $data[] = ['id'=>$user->id ,'name'=>$user->name ,  
                'hr'=>$user->totalSum($now , '' , '.hr') ,'rbi'=>$user->totalSum($now , '' , '.rbi') ,
                'atbat'=>$user->totalSum($now , '' , '.at_bat') ,'ave'=>$user->totalaverage($now,'','.hits','.at_bat'),
                'rank'=>$rank.'位'];
            }elseif($usergamesCount == 0){
                $data = [];
            }
             
        }
        $collection = collect($data)->sortByDesc($col);
        //dd($collection);
        return $collection;
    }
    
    public function getAveRank()
    {
        $gameCount = Game::count();
        $count = 0;
        $rank = 1 ;
        $cnt = 1;
        $comparison = 0;
        $users = $this->addCollection('ave');
        $ave = [];
        $Ave = [];
        foreach($users as $key=>$user)
        {
            if($gameCount <= $user['atbat'])
            {
                if($comparison != $user['ave'])
                {
                   $rank = $cnt; 
                }
                $comparison = $user['ave'];
                $cnt++;
                $ave[] = ['rank' => $rank.'位' , 'name' => $user['name']  , 'ave' => $user['ave']];
                //echo $point;
                if($rank <= 3)
                {
                    $count++;
                }
            }
        }
        $Ave = collect($ave)->take($count);
        return $Ave;
    }
    
    public function getHrRank()
    {
        $count = 0;
        $rank = 1 ;
        $cnt = 1;
        $comparison = 0;
        $users = $this->addCollection('hr');
        $hr = [];
        $HR = [];
        foreach($users as $key=>$user)
        {
            if($user['hr'] !== 0)
            {
                if($comparison != $user['hr'])
                {
                   $rank = $cnt; 
                }
                $comparison = $user['hr'];
                $cnt++;
                $hr[] = ['rank' => $rank.'位' , 'name' => $user['name']  , 'hr' => $user['hr']];
                dd($hr);
                //echo $point;
                if($rank <= 3)
                {
                    $count++;
                }
            }
        }
        $HR = collect($hr)->take($count);    
        //dd($HR);
        return $HR;
    }
    
    public function getRbiRank()
    {
        $count = 0;
        $rank = 1 ;
        $cnt = 1;
        $comparison = 0;
        $users = $this->addCollection('rbi');
        $rbi = [];
        $RBI = [];
        foreach($users as $key=>$user)
        {
            if($user['rbi'] !== 0)
            {
                if($comparison != $user['rbi'])
                {
                   $rank = $cnt; 
                }
                $comparison = $user['rbi'];
                $cnt++;
                $rbi[] = ['rank' => $rank.'位' , 'name' => $user['name']  , 'rbi' => $user['rbi']];
                //echo $point;
                if($rank <= 3)
                {
                    $count++;
                }
            }
        }
        $RBI = collect($rbi)->take($count);     
        return $RBI;
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
