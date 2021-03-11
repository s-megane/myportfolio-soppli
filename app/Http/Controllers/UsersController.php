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
    
    //ユーザー一覧とランキングを表示する
    public function index(UserService $User)
    {
        if (\Auth::check()) {
            $users = User::orderBy("role")->paginate(10);
            $aveColl = $User->getAveRank(); 
            $hrColl = $User->getRank('hr');
            $rbiColl= $User->getRank('rbi');
        }
        return view("users.index" , compact('users','aveColl','hrColl','rbiColl'));
    }
    
    //ユーザーの詳細画面
    public function show(UserService $User , valiRequest $request ,$id)
    {
        $user = User::findOrFail($id);
        //評価する能力を配列にする
        $abilitys = ["meet" ,"power" ,"run" ,"defense", "shoulder"];
        //検索窓の年
        $year = $request->input('getyear');
        //検索窓の対戦相手
        $opponent = $request->input('getopponent');
        //前のユーザー詳細へ遷移
        $prev = User::where('id','<',$user->id)->orderBy('id','desc')->first();
        //次のユーザー詳細へ遷移
        $next = User::where('id','>',$user->id)->orderBy('id')->first();
        //検索結果処理
        $data = $User->getserch($id,$opponent,$year);
        return view('users.show',compact('user','year','opponent','data','abilitys','prev','next'));
    }
    //プロフィール編集画面
    public function edit($id)
    {
        $user = User::findOrFail($id);
        //生年月日を分解して表示する(修正する際に必要)
        $birth = $user->birthday;
        $date = new Carbon($birth); 
        $myyear = $date->year;
        $mymonth = $date->month;
        $myday = $date->day;
        //自分だったら編集画面に遷移
        if(\Auth::id() === $user->id){
            return view("users.edit" , [
                "user" => $user,
                "myyear"=>$myyear,
                "mymonth"=>$mymonth,
                "myday"=>$myday,
            ]);
        }
    }
    //プロフィール更新処理
    public function update(ProfileRequest $request, $id)
    {
        $user = User::findOrFail($id) ;
        //自分だったらプロフィールの更新を行う
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
    
    //ユーザー退会前の確認画面へ遷移
    public function userdelete($id)
    {
        $user = User::findOrFail($id);
        
        return view("users.delete" , [
                "user" => $user ,
        ]);
        
    }
    
    //ユーザー削除
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        //自分だったら
        if (\Auth::id() === $user->id)
        {
            //ログアウト
            \Auth::logout();
            //削除
            $user->delete();
        }
        return redirect("/");
    }
}
