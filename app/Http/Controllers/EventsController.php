<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Services\EventService;
use App\Event;
use App\User;
use App\Game;
use DB;
class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    //イベント一覧取得 
    public function index(EventService $Event)
    {
        $data = $Event->getIndexData();
        return view("welcome" , $data);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    //イベントの詳細を表示する 
    public function show($id)
    {
        $event = Event::findOrFail($id);
        $exists = $event->attendances()->pluck('user_id')->toArray();
        $users = User::whereNotIn('id', $exists)->get();
        return view("events.show" , compact("event" , "users" , "exists"));
    }
}
