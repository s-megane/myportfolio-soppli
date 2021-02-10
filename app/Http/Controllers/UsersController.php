<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\User;
use Carbon\Carbon;
use DB;
use App\Http\Requests\valiRequest;
use App\Http\Requests\ProfileRequest;
class UsersController extends Controller
{
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
    
    public function index(UserService $User)
    {
        if (\Auth::check()) {
            $users = User::orderBy("role")->paginate(10);
            $aveColl = $User->getAveRank(); 
            $hrColl = $User->getHrRank();
            $rbiColl= $User->getRbiRank();
            //dd(empty($aveColl),$hrColl,$rbiColl);
        }
        return view("users.index" , compact('users','aveColl','hrColl','rbiColl'));
    }
    
    public function show(UserService $User , valiRequest $request ,$id)
    {
        $user = User::findOrFail($id);
        $abilitys = ["meet" ,"power" ,"run" ,"defense", "shoulder"];
        $year = $request->input('getyear');
        $opponent = $request->input('getopponent');
        $prev = User::where('id','<',$user->id)->orderBy('id','desc')->first();
        $next = User::where('id','>',$user->id)->orderBy('id')->first();
        $data = $User->getserch($id,$opponent,$year);
        
        return view('users.show',compact('user','year','opponent','data','abilitys','prev','next'));
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
    
    public function update(ProfileRequest $request, $id)
    {
        // $request->validate([ 
        //     "content" => "required" ,
        //     "status" => "required|max:10" ,
        // ]);
        
        $user = User::findOrFail($id) ;
        if (\Auth::id() === $user->id){
            $user->name = $request->Name ;
            $user->birthday = $request->year."-" .sprintf('%02d',$request->month)."-".sprintf('%02d',$request->day);
            $user->mynum = $request->mynum;
            $user->dominant_def = $request->dominant_def;
            $user->dominant_bat = $request->dominant_bat;
            $user->email = $request->Email;
            $user->save();
        }
        
        return redirect()->action("UsersController@show",[$user->id]);
    }
    public function userdelete($id)
    {
        $user = User::findOrFail($id);
        
            return view("users.delete" , [
                    "user" => $user ,
            ]);
        
    }
    
    public function ranking ()
    {
        
        //dd($aveColl);
        //return view('users.ranking' ,compact('aveColl', 'hrColl'  , 'rbiColl'));
    }
    
}
