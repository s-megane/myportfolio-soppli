<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
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
        if (\Auth::id() === $user->id){
           \Auth::logout();
           $user->delete();
        }
            //session()->flash('flash_message', '退部しました。今までお世話になりました。');
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
    
    public function edit($id){
        
        $user = User::findOrFail($id);
        $birth = $user->birthday;
        $date = new Carbon($birth); 
        $myyear = $date->year;
        $mymonth = $date->month;
        $myday = $date->day;
        
        if(\Auth::id() ===$user->id){
            return view("users.edit" , [
                "user" => $user,
                "myyear"=>$myyear,
                "mymonth"=>$mymonth,
                "myday"=>$myday,
            ]);
        }
    }
    
    public function update(Request $request, $id)
    {
        // $request->validate([ 
        //     "content" => "required" ,
        //     "status" => "required|max:10" ,
        // ]);
        
        $user = User::findOrFail($id) ;
        if (\Auth::id() === $user->id){
            $user->name = $request->name ;
            $user->birthday = $request->year."-" .sprintf('%02d',$request->month)."-".sprintf('%02d',$request->day);
            $user->mynum = $request->mynum;
            $user->dominant_def = $request->dominant_def;
            $user->dominant_bat = $request->dominant_bat;
            $user->save();
        }
        
        return redirect('/');
    }
    public function userdelete($id)
    {
        $user = User::findOrFail($id);
        
            return view("users.delete" , [
                    "user" => $user ,
            ]);
        
    }
}
