<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\valiRequest;
class EvaluationController extends Controller
{
    public function store(valiRequest $request ,$id)
    {
        $user = User::findorfail($id);
        
        if(!\Auth::user()->is_evaluations($user->id))
        {
            \Auth::user()->evaluations()->attach($id ,[
                "meet" => $request->meet,
                "power" => $request->power ,
                "run" => $request->run ,
                "defense" => $request->defense,
                "shoulder" => $request->shoulder,]);
        }
        return redirect()->action('UsersController@show', [$user->id]);
        
    }
    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view("evaluations.edit" ,[
                "user" => $user,
        ]);
    }
    
    public function update (valiRequest $request,$id)
    {
        $user = User::findorfail($id);
        //\Auth::user()->evaluations()->where("target_id" , \Auth::id())->sum("power")->get();
        \Auth::user()->evaluations()->updateExistingPivot($id ,[
            "meet" => $request->meet,
            "power" => $request->power ,
            "run" => $request->run ,
            "defense" => $request->defense,
            "shoulder" => $request->shoulder,]);
        return redirect()->action('UsersController@show', [$user->id]);    
    }
    
    // public function show($id)
    // {
    //     // $abilitys = ["meet" ,"power" ,"run" ,"defense", "shoulder"];
    //     // $user = User::findOrFail($id);
    //     return view("evaluations.show" );    
    // }
}
