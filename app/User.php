<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

use DB;
use App\Game;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', "role" ,'getyear' , 'getopponent'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function attendances()
    {
        return $this->belongsToMany(Event::class, "attendances" , "user_id", "event_id")->withPivot("status")->withTimestamps();
    }
    
    public function loadRelationshipCounts()
    {
        $this->loadCount('attendances');
    }
    
    public function is_attendance($eventId)
    {
        return $this->attendances()->where("event_id" , $eventId)->exists();
    }
    //ユーザーの年齢を計算
    public function user_age()
    {
        $now = Carbon::now();
        $year = $now->year ;
        $month = sprintf('%02d',$now->month);
        $day = sprintf('%02d',$now->day);
        $birth = $this->birthday;
        $date = new Carbon($birth); 
        $myyear = $date->year;
        $mymonth = sprintf('%02d',$date->month);
        $myday = sprintf('%02d',$date->day);
        $dayA = $year.$month.$day;
        $dayB = $myyear.$mymonth.$myday;
        return $age = floor(($dayA-$dayB)/10000);
    }
    
    public function evaluations()
    {
        return $this->belongsToMany(User::class,"evaluation_target" , "evaluation_id" , "target_id")->withPivot("meet","power","run","defense","shoulder")->withTimestamps();
    }
    public function targets()
    {
        return $this->belongsToMany(User::class , "evaluation_target" , "target_id" , "evaluation_id")->withPivot("meet","power","run","defense","shoulder")->withTimestamps();
    }
    
    public function is_evaluations($userId)
    {
        return $this->evaluations()->where("target_id" ,$userId)->exists();
    }
    //選択したユーザーの自分が評価した数値を取得(更新するとき)
    public function getAbility ($userId,$Col)  
    {
        return \Auth::user()->evaluations()->where("target_id" ,$userId)->value($Col);
    }
    
    public function Ability ($userId,$col)
    {
        return $Ability = DB::table("evaluation_target")->where("target_id", $userId)->sum($col); 
    }
    //ユーザーの獲得した評価値を条件によって表示する
    public function myAbility($userId,$col)
    {
        //最高評価値
        $max = 8;
        //評価した人数
        $userCount = $this->targets()->count();
        //評価値取得
        $Ability = DB::table("evaluation_target")->where("target_id", $userId)->sum($col);
        $result =$Ability/($max*$userCount);
        if($userCount == 1){
            if($Ability == 8 ){
                return $myAbility = "S";
            }elseif($Ability == 7){
                return $myAbility = "A";
            }elseif($Ability == 6){
                return $myAbility = "B";
            }elseif($Ability == 5 ){
                return $myAbility = "C";
            }elseif($Ability == 4 ){
                return $myAbility = "D";
            }elseif($Ability == 3 ){
                return $myAbility = "E";
            }elseif($Ability == 2 ){ 
                return $myAbility = "F";
            }elseif($Ability == 1 ){ 
                return $myAbility = "G";
            }
        }else{
            if($result >= 0.9 ){
                return $myAbility = "S";
            }elseif($result >= 0.8 ){
                return $myAbility = "A";
            }elseif($result >= 0.7 ){
                return $myAbility = "B";
            }elseif($result >= 0.6 ){
                return $myAbility = "C";
            }elseif($result >= 0.5 ){
                return $myAbility = "D";
            }elseif($result >= 0.4 ){
                return $myAbility = "E";
            }elseif($result >= 0.3 ){ 
                return $myAbility = "F";
            }elseif($result >= 0.1 ){ 
                return $myAbility = "G";
            }
        }
    }
    
    public function usergames()
    {
        return $this->belongsToMany(Game::class,'users_games','user_id','game_id')
                ->withPivot('at_bat','hits','hr','rbi','steal','winlose','innings','conceded','strikeout')->withTimestamps();
    }
    
    public function is_games($gameId)
    {
        return $this->usergames()->where("game_id" ,$gameId)->exists();
    }
    //試合ごとの成績を取得する(計算を必要としないもの)
    public function getmydata($gameId,$col)
    {
        return $this->usergames()->with('usergames')->where('game_id' , $gameId)->value($col);
    }
    
    //試合ごと打率計算
    public function getaverage($gameId)
    {
        $hits = $this->usergames()->with('usergames')->where('game_id' , $gameId)->sum('users_games.hits');
        $atbat = $this->usergames()->with('usergames')->where('game_id' , $gameId)->sum('users_games.at_bat');
        if($hits == 0){
            $average = '.000';
        }elseif ($hits == $atbat){
            $average = number_format(($hits / $atbat) , 3); //1.000
        }else{
            $average =  substr(number_format(($hits / $atbat) , 3) , 1); //.XXX
        }    
        return $average;
    }
    
    //試合ごと防御率計算
    public function geteraverage($gameId)
    {
        $innings = $this->usergames()->with('usergames')->where('game_id' , $gameId)->sum('users_games.innings');
        $conceded = $this->usergames()->with('usergames')->where('game_id' , $gameId)->sum('users_games.conceded');
        
        if($innings == 0 && empty($innings))
        {
            $eraverage = "-";
        }elseif($conceded == 0){
            $eraverage = number_format(0, 2);
            
        }else{
            $eraverage = number_format(($conceded * 5)/ $innings, 2);
        }
        return  $eraverage;
    }
    
    //年間打率計算
    public function totalaverage($year,$opponent,$col1,$col2)
    {
        $totalhits = $this->totalSum($year , $opponent , $col1);
        $totalatbat = $this->totalSum($year , $opponent , $col2);
        if($totalhits == 0){
            $totalaverage = '.000';
        }elseif ($totalhits == $totalatbat){
            $totalaverage = number_format(($totalhits / $totalatbat) , 3); //1.000
        }else{
            $totalaverage =  substr(number_format(($totalhits / $totalatbat) , 3) , 1); //.XXX
        }    
        return $totalaverage;
    }
    
    //年間成績取得　年と対戦相手で検索できる
    public function totalSum($year , $opponent , $col)
    {
        $now = Carbon::now()->year;
        $query = $this->usergames();
        if(!empty($year) && empty($opponent))
        {
            $query->whereYear('users_games.created_at' , 'like' , '%' . $year . '%');
        }
        if(!empty($year) && !empty($opponent)){
            
            $query->whereYear('users_games.created_at' , $year);
            $query->where('opponent' , 'like' , '%' . $opponent . '%');
        }
        if(empty($year) && !empty($opponent))
        {
            $query->where('opponent' , 'like' , '%' . $opponent . '%');
        }
        $totalSum = $query->sum('users_games'.$col);
        return $totalSum;
    }
    
    //年間防御率計算
    public function totalerave($year,$opponent,$col1,$col2)
    {
        $innings = $this->totalSum($year,$opponent,$col1);
        $conceded = $this->totalSum($year,$opponent,$col2);
        //登板がなければ
        if(($innings || $conceded) == 0)
        {
            return "-";
        }else{
            //防御率= 失点×5イニング÷投球回数
            return number_format(($conceded * 5)/ $innings, 2);
        }
    }
    //年間勝敗数
    public function getwinlose($year,$opponent,$col)
    {
        $now = Carbon::now()->year;
        $query = $this->usergames();
        if(empty($year))
        {
            $year = $now;
        }
        if(empty($opponent)){
            $winlose = $this->usergames()->whereYear('users_games.created_at' ,$year)
                ->where('users_games.winlose',$col)->get();    
        }else{
            $winlose = $winlose = $this->usergames()->whereYear('users_games.created_at' ,$year)->where([
                ['users_games.winlose',$col],
                ['opponent' , $opponent]])->get();     
        }
        return  count($winlose);  
    }
    //出場試合数
    public function getmyCount($year,$opponent)
    {
        $now = Carbon::now()->year;
        //$mycount = $this->usergames()->whereYear('users_games.created_at' , $year)->where('opponent','ペインターズ')->count();
        if(empty($year))
        {
            $year = $now;
        }
        if(empty($opponent) && !empty($year)){
            $mycount = $this->usergames()->whereYear('users_games.created_at' , $year)->count();   
        }
        if(!empty($year) && !empty($opponent)){
            $mycount = $this->usergames()->whereYear('users_games.created_at' ,$year)
                ->where('opponent' , 'like' , '%' . $opponent . '%')->count();     
        }
        return $mycount;    
    }
    //登板回数
    public function getPcount($year,$opponent)
    {
        $now = Carbon::now()->year;
        if(empty($year))
        {
            $year = $now;
        }
        if(empty($opponent)){
            $mycount = $this->usergames()->whereYear('users_games.created_at' , $year)
            ->whereNotnull('users_games.innings')->count('users_games.innings');   
        }else{
            $mycount = $this->usergames()->whereYear('users_games.created_at' ,$year)
                ->where('opponent' , 'like' , '%' . $opponent . '%')->whereNotnull('users_games.innings')->count();     
        }return $mycount;
        
    }    
       
}


