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
            $events = Event::take(5)->orderBy("created_at" ,"desc")->paginate(5);
            $users = User::orderBy("role")->paginate(10);
            $data = [
                "users" => $users ,
                "events" => $events ,
            ];
        }
        return view('admin' , $data);    
       
    }
    //
}
