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
    public function index(EventService $Event)
    {
        $data = $Event->getIndexData();
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
        return view('events.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request , EventService $Event)
    {
        //イベントデータ作成
        $event = new Event;
        $event->fill($request->all())->save();
        //作成イベントの開催日を取得
        $eventdate = $event->eventdate;
        //作成イベントデータのidを取得
        $eventId = $event->id;
        //作成イベントのタイトルを取得
        $title = $event->title;
        //作成イベントの回答締め切り日を取得
        $deadlinedate = $event->deadlinedate;
        //イベントが、大会名なら、試合データを作成(2試合)
        if($title == "練習"||$title == "親睦会" )
        {
        }else{
            $gameSave = $Event->getCreateData($eventId);
        }
        //自分のカレンダーに、回答締め切り日を登録する
        $clendarSave = $Event->getCalendarData($eventdate,$deadlinedate,$title,$eventId);
        return redirect()->action('EventsController@show' , [$event->id]);
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
        return view("events.show" , compact("event" , "users" , "exists"));
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
        if (\Auth::user()->role <= 2){
            return view("events.edit" ,compact("event")); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, EventService $Event,$id)
    {
        if (\Auth::user()->role <= 2)
        {
            $event = Event::findOrFail($id);
            $event->fill($request->all())->save();
            //更新後の回答締め切り日を取得
            $updateEventDate = $event->deadlinedate;
            $updateCevent = $Event->updateCevent($updateEventDate , $event->id);
            return redirect()->action('EventsController@show' , [$event->id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventService $Event,$id)
    {
        //イベントを削除したら、カレンダーも削除する
        $event = Event::findOrFail($id);
        if (\Auth::user()->role <= 2){
           $CeventDelete = $Event->deleteCevent($event->id);
           $event->delete();
           return redirect("/admin");
        }
            
            
    }
}
