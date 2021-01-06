<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Event;
class AdminController extends Controller
{
    public function index () 
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
        return view('admin' , $data);    
       
    }
    //
}
