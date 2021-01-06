<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', "role" ,
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
    
   
    
    // public function ud_unattendance ($eventId)
    // {
    //     $user = \Auth::user();
    //     $exist = $this->is_attendance($eventId);
    //     $statusId = $user->attendances()->find($eventId)->status;
        
    //     //もし、登録してて、ステータスが1じゃなかったら（参加以外なら）
    //     if($exist && !$statusId == 2){
    //         $status = 2;
    //         $this->attendances()->updateExistingPivot($eventId ,["status" => $status]);
    //     }
    // }
    
    
    // public function attendance($eventId){
    //     $status = 1;
    //     $exist = $this->is_attendance($eventId);
    //     //dd($exist);
    //     if($exist){
    //         return false;
    //     }else{
    //         $this->attendances()->attach($eventId ,["status" => $status]);
    //         return true;
    //     }
    // }
    
    
    
   

    
    public function is_attendance($eventId)
    {
        return $this->attendances()->where("event_id" , $eventId)->exists();
    }
}


