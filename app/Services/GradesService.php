<?php
namespace App\Services;
use App\Event;
use App\Game;
use App\User;
use Carbon\Carbon;
use DB;

class GradesService 
{
    //ユーザーが今年参加した大会の一覧を取得する
    public function getData()
    {
        //今年の年を取得
        $year = Carbon::now()->year;
        $user = \Auth::user(); 
        //自分が今年のイベントの中で参加したイベントを取得
        $getEvents = $user->attendances()->whereYear('attendances.created_at' , $year)->where('attendances.status' , 1)->orderBy('attendances.id','desc')->get();
        return $getEvents;
    }
}