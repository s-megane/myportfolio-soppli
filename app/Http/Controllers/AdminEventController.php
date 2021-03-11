<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Services\EventService;
use App\Event;
use App\User;
use App\Game;
use DB;
class AdminEventController extends Controller
{
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
    //イベントの新規登録及び試合データ登録、カレンダーへ予定登録 
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
    //イベントの変更及び、カレンダーの日付変更 
    public function update(EventRequest $request, EventService $Event,$id)
    {
        //キャプテン以上の権限があれば実行可能
        if (\Auth::user()->role <= 2)
        {
            $event = Event::findOrFail($id);
            $event->fill($request->all())->save();
            //更新後の回答締め切り日を取得
            $updateEventDate = $event->deadlinedate;
            //カレンダーの回答締め切り日を更新する
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
    //イベントを削除及びカレンダー削除 
    public function destroy(EventService $Event,$id)
    {
        
        $event = Event::findOrFail($id);
        //キャプテン以上の権限があれば実行可能
        if (\Auth::user()->role <= 2){
            //カレンダーを削除した後、イベントを削除する
           $CeventDelete = $Event->deleteCevent($event->id);
           $event->delete();
           return redirect("/admin");
        }
            
            
    }
}
