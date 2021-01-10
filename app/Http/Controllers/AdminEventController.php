<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
class AdminEventController extends Controller
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
        return view("admin" , $data);    
       
    }
}
