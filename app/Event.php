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
    
    public function loadRelationshipCounts()
    {
        $this->loadCount('attendances');
    }
}
