<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendancesController extends Controller
{
    public function store(Request $request, $id) {
        $statusId = $request->get('status');
        \Auth::user()->attendances()->attach($id ,["status" => $statusId]);
        return back();
    }
    
    public function update(Request $request, $id)
    {
        $statusId = $request->get('status');
        \Auth::user()->attendances()->updateExistingPivot($id ,["status" => $statusId]);
        return back();
    }
    
    public function show()
    {
        $users = User::all();
        //$attendances = $user->attendances()->where("status",1)($id);
        
        return view("events.show" , [
            "users" => $users,
            ]);
    } 
}
