<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use DB;
class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [] ;
        if (\Auth::check()){
            $events = Event::orderBy("created_at")->get();
            $users = User::orderBy("role")->get();
            $data = [
                "users" => $users ,
                "events" => $events ,
            ];
        }
        return view("welcome" , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = new Event;

        // メッセージ作成ビューを表示
        return view('events.create', [
            'event' => $event,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Event::create([
            "eventdate" => $request->eventdate ,
            "title" => $request->title ,
            "place" => $request->place ,
            "meetingtime" => $request->meetingtime ,
            "deadlinedate" => $request->deadlinedate ,
            
        ]);
        
       return redirect('/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        $exists = $event->attendances()->pluck('user_id')->toArray();
        $users = User::whereNotIn('id', $exists)->get();
        
        return view("events.show" , [
            "event" => $event ,  
            "users" => $users ,
            "exists" => $exists,          
        ]);
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        if (\Auth::user()->role ===1){
            return view("events.edit" , [
               "event" => $event, 
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (\Auth::user()->role ===1){
            $event = Event::findOrFail($id);
            $event->eventdate = $request->eventdate;
            $event->title = $request->title;
            $event->place = $request->place;
            $event->meetingtime = $request->meetingtime;
            $event->deadlinedate = $request->deadlinedate;
            $event->save();
            return redirect('/admin');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        if (\Auth::user()->role === 1){
           $event->delete();
           return redirect("/admin");
        }
            
            
    }
}
