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
            if($usergamesCount > 0)  //users_gamesが0じゃなければコレクション配列作成
            {
                $data[] = ['id'=>$user->id ,'name'=>$user->name ,  
                'hr'=>$user->totalSum($now , '' , '.hr') ,'rbi'=>$user->totalSum($now , '' , '.rbi') ,
                'atbat'=>$user->totalSum($now , '' , '.at_bat') ,'ave'=>$user->totalaverage($now,'','.hits','.at_bat'),
                'rank'=>$rank.'位'];
            }elseif($usergamesCount == 0){
                $data = [];
            }
        }
        //配列をコレクションにし、ソートする
        $collection = collect($data)->sortByDesc($col);
        return $collection;
    }
    
    //打率ランキング
    public function getAveRank()
    {
        //試合数=規定打席
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
            //自分の打数が規定打席以上ならランキングの対象になる
            if($gameCount <= $user['atbat'])
            {
                //ランキングの同率処理を行う
                if($comparison != $user['ave'])
                {
                   $rank = $cnt; 
                }
                
                $comparison = $user['ave'];
                $cnt++;
                //表示に必要な項目だけで配列を作る
                $ave[] = ['rank' => $rank.'位' , 'name' => $user['name']  , 'ave' => $user['ave']];
                
                //3位まで表示する
                if($rank <= 3)
                {
                    $count++;
                }
            }
        }
        //配列をコレクションにし、表示制限を行う
        $Ave = collect($ave)->take($count);
        return $Ave;
    }
    
    //HR数と打点数のランキング表示　$colはhrか打点
    public function getRank($col)
    {
        $count = 0;
        $rank = 1 ;
        $cnt = 1;
        $comparison = 0;
        $users = $this->addCollection($col);
        $data = [];
        $rankdata = [];
        foreach($users as $key=>$user)
        {
            //HRか打点が1以上ならランキングの対象になる
            if($user[$col] !== 0)
            {
                //同率処理
                if($comparison != $user[$col])
                {
                   $rank = $cnt; 
                }
                $comparison = $user[$col];
                $cnt++;
                //表示に必要な項目だけで配列を作る
                $data[] = ['rank' => $rank.'位' , 'name' => $user['name']  , $col => $user[$col]];
                
                //3位まで表示する
                if($rank <= 3)
                {
                    $count++;
                }
            }
        }
        //配列をコレクションにし、表示制限を行う
        $rankdata = collect($data)->take($count);    
        return $rankdata;
    }
    
    //個人成績を条件で検索し表示する
    public function getserch($id,$opponent,$year)
    {
        $user = User::findOrFail($id);
        $query = $user->usergames();
        //年の指定があればその年で検索する
        if(empty($opponent) && !empty($year))
        {
            $query->whereYear('users_games.created_at' , 'like' , '%' . $year . '%');
        } 
        //対戦相手の指定があればその相手で検索する
        if(!empty($opponent) && empty($year))
        {
            
            $query->where('opponent' , 'like' , '%' . $opponent . '%');
        }
        //年と対戦相手の指定があればそれで検索する
        if(!empty($opponent) && !empty($year))
        {
            $query->whereYear('users_games.created_at' , 'like' , '%' . $year . '%');
            $query->where('opponent' , 'like' , '%' . $opponent . '%');
        }
        $data = $query->get();
        return $data ;
    }
    
}
