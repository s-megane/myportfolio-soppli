<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UsersController extends Controller
{
    //public function userdelete($id)
    //{
        
       // if (\Auth::check()) { // 認証済みの場合
         //   $user = User::findOrFail($id);
       // }
        //return view("users.delete" , [
          //      "user" => $user ,
           // ]);
   // }
    
    public function destroy($id)
    {
       $user = User::findOrFail($id);
       \Auth::logout();
       $user->delete();
       return redirect("/");
    }
    
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $users = User::orderBy("role")->get();
            
                $data = [
                    "users" => $users ,
                ];
        }
        return view("welcome" , $data);
    }
    
    public function show($id)
    {
        $user = User::findOrFail($id);
        
        return view("users.show" ,[
            "user" => $user ,    
        ]);
    }
    
}
