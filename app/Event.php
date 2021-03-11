<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ["eventdate" , "title" , "place" ,"meetingtime" , "deadlinedate"];
    
    public function Attendances()
    {
       return $this->belongsToMany(User::class, "attendances" , "event_id", "user_id")->withPivot("status")->withTimestamps();
    }
    
    public function games()
    {
        return $this->hasMany(Game::class);
    }
    
    //googleカレンダーのカレンダーイベントとの関係
    public function calendar()
    {
        return $this->hasOne(Calendar::class);
    }
    
    //
    // public function year_get($year)
    // {
    //     return $getdate = Event::whereYear('eventdate' , $year)->get();
    // }
}
