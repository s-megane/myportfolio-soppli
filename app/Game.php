<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;
class Game extends Model
{
    protected $fillable = ['title','opponent','myscore','oppscore'];
    
    //試合:イベント　1:多
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    //試合結果取得
    public function result ($numA,$numB)
    {
        if($numA - $numB < 0){
            return $date = "負";
        }elseif($numA == $numB){
            return $date = "引";
        }else{
            return $date = "勝";
        }
    }
    //勝ち数、負け数、引き分けを取得する　($statusには<,>,=が入る)
    public function win_lose ($year,$status)
    {
        return $win = Game::whereyear('created_at' , $year)->whereColumn('myscore', $status, 'oppscore')->count();
    }
    
    //試合:ユーザー 多:多
    public function usergames()
    {
        return $this->belongsToMany(User::class,'users_games','game_id','user_id')
            ->withPivot('at_bat','hits','hr','rbi','steal','winlose','innings','conceded','strikeout')->withTimestamps();
    }
}
