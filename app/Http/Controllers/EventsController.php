<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
class EventsController extends Controller
{
     public function index()
    {
        $data = [] ;
        if (\Auth::check()){
            $events = Event::all();
            $users = User::orderBy("role")->get();
            $data = [
                "users" => $users ,
                "events" => $events ,
            ];
        }
        return view("welcome" , $data);    
       
    }
    
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view("events.show" , [
            "event" => $event ,  
        ]);
        
    }
    
}
